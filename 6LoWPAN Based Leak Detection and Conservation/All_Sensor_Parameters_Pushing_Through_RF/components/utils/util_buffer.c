/***********************************************************************************
  Filename:     util_buffer.c

  Description:  Ringbuffer implementation.

***********************************************************************************/

/***********************************************************************************
* INCLUDES
*/
#include "util_buffer.h"
#include "hal_board.h"
#include "hal_int.h"
#include "hal_assert.h"

cmdBuff_t cmdBuff;
volatile unsigned char command_rcvd=0;
#define OFFSET 1
/***********************************************************************************
* GLOBAL FUNCTIONS
*/

/***********************************************************************************
* @fn      bufInit
*
* @brief   Initialise a ringbuffer. The buffer must be allocated by the
*          application.
*
* @param   pBuf - pointer to the ringbuffer
*
* @return  none
*/
void bufInit(ringBuf_t *pBuf)
{
    uint16 s;

    // Critical section start
    s = halIntLock();

    pBuf->nBytes= 0;
    pBuf->iHead= 0;
    pBuf->iTail= 0;

    // Critical section end
    halIntUnlock(s);
}

void cmdBufInit(void){
    uint8 i;
    for(i=0;i<BUF_SIZE;i++){
        cmdBuff.data[i] = 0;
    }
    cmdBuff.index = 0;
}
/***********************************************************************************
* @fn      bufPut
*
* @brief   Add bytes to the buffer.
*
* @param   pBuf - pointer to the ringbuffer
*          pData - pointer to data to be appended to the buffer
*          nBytes - number of bytes
*
* @return  Number of bytes copied to the buffer
*/
uint8 bufPut(ringBuf_t *pBuf, const uint8 *pData, uint8 nBytes)
{
    uint8 i;
    uint16 s;

    // Critical section start
    s = halIntLock();
    
    if (pBuf->nBytes+nBytes < BUF_SIZE) {

        i= 0;
        while(i<nBytes) {
            pBuf->pData[pBuf->iTail]= pData[i];
            pBuf->iTail++;
            if (pBuf->iTail==BUF_SIZE)
                pBuf->iTail= 0;
            i++;
        }
        pBuf->nBytes+= i;
    } else {
        i= 0;
    }

    // Critical section end
    halIntUnlock(s);

    return i;
}

uint8 cmdBufPut(uint8 data){
    
  /*if(cmdBuff.index == BUF_SIZE){
      cmdBufInit();
      return 0;
  } else {
      if(data != '\n'){
        cmdBuff.data[cmdBuff.index] = data;
        cmdBuff.index++;
        return 1;
      } else {
         command_rcvd=1;
      }
  }*/
  if(cmdBuff.index == BUF_SIZE){
    cmdBufInit();
    command_rcvd = 0;
    return 0;
  } else {
    cmdBuff.data[cmdBuff.index] = data;
    cmdBuff.index++;
      if(cmdBuff.index == 18 && cmdBuff.data[0] == 0xEF){
        command_rcvd = 1;
	UC1IE &= ~UCA1RXIE;
      }
  }
  return 1;
}

/***********************************************************************************
* @fn      bufGet
*
* @brief   Extract bytes from the buffer.
*
* @param   pBuf   - pointer to the ringbuffer
*          pData  - pointer to data to be extracted
*          nBytes - number of bytes
*
* @return  Bytes actually returned
*/
uint8 bufGet(ringBuf_t *pBuf, uint8 *pData, uint8 nBytes)
{
    uint8 i;
    uint16 s;

    // Critical section start
    s = halIntLock();

    i= 0;
    while(i<nBytes && i<pBuf->nBytes) {
        pData[i]= pBuf->pData[pBuf->iHead];
        pBuf->iHead++;
        if (pBuf->iHead==BUF_SIZE)
            pBuf->iHead= 0;
        i++;
    }
    pBuf->nBytes-= i;

    // Critical section end
    halIntUnlock(s);
    return i;
}

uint8 cmdBuffGet(atCmd_t *cmd){
  
  uint8 flag=0;
  if(cmdBuff.index > 0){
      cmd->mode = cmdBuff.data[MODE];
      cmd->channel = cmdBuff.data[CHNLNO];
      cmd->panID = (uint16)(((((uint16)(cmdBuff.data[PANID+1])))<<8) | (cmdBuff.data[PANID]));
      for(flag = SRC_MAC_ADDR; (flag - SRC_MAC_ADDR )<8; flag++){
        cmd->srcMacAddr[flag - SRC_MAC_ADDR] = cmdBuff.data[flag];
      }
      cmd->srcAddr = (uint16)(((((uint16)(cmdBuff.data[SRC_NWK_ADDR+1])))<<8) | (cmdBuff.data[SRC_NWK_ADDR]));
      if(cmd->mode == 0x01){
          cmd->destAddr = (uint16)(((((uint16)(cmdBuff.data[DEST_NWK_ADDR+1])))<<8) | (cmdBuff.data[DEST_NWK_ADDR]));
          cmd->txPower = cmdBuff.data[TX_POW];
      }
      flag = 1;
  }
  cmdBufInit();
  command_rcvd=0;
  return flag;
}

/***********************************************************************************
* @fn      bufPeek
*
* @brief   Read bytes from the buffer but leave them in the queue.
*
* @param   pBuf   - pointer to the ringbuffer
*          pData  - pointer to data to be extracted
*          nBytes - number of bytes
*
* @return  Bytes actually returned
*/
uint8 bufPeek(ringBuf_t *pBuf, uint8 *pData, uint8 nBytes)
{
    uint8 i,j;
    uint16 s;

    // Critical section start
    s = halIntLock();

    i= 0;
    j= pBuf->iHead;
    while(i<nBytes && i<pBuf->nBytes) {
        pData[i]= pBuf->pData[j];
        j++;
        if (j==BUF_SIZE)
            j= 0;
        i++;
    }

    // Critical section end
    halIntUnlock(s);
    return i;
}


/***********************************************************************************
* @fn      bufNumBytes
*
* @brief   Return the byte count for the ring buffer.
*
* @param   pBuf- pointer to the buffer
*
* @return  Number of bytes present.
*/
uint8 bufNumBytes(ringBuf_t *pBuf)
{
    return pBuf->nBytes;
}

/***********************************************************************************
  Copyright 2007 Texas Instruments Incorporated. All rights reserved.

  IMPORTANT: Your use of this Software is limited to those specific rights
  granted under the terms of a software license agreement between the user
  who downloaded the software, his/her employer (which must be your employer)
  and Texas Instruments Incorporated (the "License").  You may not use this
  Software unless you agree to abide by the terms of the License. The License
  limits your use, and you acknowledge, that the Software may not be modified,
  copied or distributed unless embedded on a Texas Instruments microcontroller
  or used solely and exclusively in conjunction with a Texas Instruments radio
  frequency transceiver, which is integrated into your product.  Other than for
  the foregoing purpose, you may not use, reproduce, copy, prepare derivative
  works of, modify, distribute, perform, display or sell this Software and/or
  its documentation for any purpose.

  YOU FURTHER ACKNOWLEDGE AND AGREE THAT THE SOFTWARE AND DOCUMENTATION ARE
  PROVIDED “AS IS” WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED,
  INCLUDING WITHOUT LIMITATION, ANY WARRANTY OF MERCHANTABILITY, TITLE,
  NON-INFRINGEMENT AND FITNESS FOR A PARTICULAR PURPOSE. IN NO EVENT SHALL
  TEXAS INSTRUMENTS OR ITS LICENSORS BE LIABLE OR OBLIGATED UNDER CONTRACT,
  NEGLIGENCE, STRICT LIABILITY, CONTRIBUTION, BREACH OF WARRANTY, OR OTHER
  LEGAL EQUITABLE THEORY ANY DIRECT OR INDIRECT DAMAGES OR EXPENSES
  INCLUDING BUT NOT LIMITED TO ANY INCIDENTAL, SPECIAL, INDIRECT, PUNITIVE
  OR CONSEQUENTIAL DAMAGES, LOST PROFITS OR LOST DATA, COST OF PROCUREMENT
  OF SUBSTITUTE GOODS, TECHNOLOGY, SERVICES, OR ANY CLAIMS BY THIRD PARTIES
  (INCLUDING BUT NOT LIMITED TO ANY DEFENSE THEREOF), OR OTHER SIMILAR COSTS.

  Should you have any questions regarding your right to use this Software,
  contact Texas Instruments Incorporated at www.TI.com.
***********************************************************************************/

