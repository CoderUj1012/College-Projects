/***********************************************************************************
  Filename: 	per_test.c

  Description:  This application functions as a packet error rate (PER) tester.
  One node is set up as transmitter and the other as receiver. The role and
  configuration parameters for the PER test of the node is chosen on initalisation
  by navigating the joystick and confirm the choices with S1.

  The configuration parameters are channel, burst size and tx power. Push S1 to
  enter the menu. Then the configuration parameters are set by pressing
  joystick to right or left (increase/decrease value) and confirm with S1.

  After configuration of both the receiver and transmitter, the PER test is
  started by pressing joystick up on the transmitter. By pressing joystick up
  again the test is stopped.

***********************************************************************************/

/***********************************************************************************
* INCLUDES
*/
#include "hal_lcd.h"
#include "hal_led.h"
#include "hal_int.h"
#include "hal_timer_32k.h"
#include "hal_joystick.h"
#include "hal_button.h"
#include "hal_board.h"
#include "hal_rf.h"
#include "hal_assert.h"
#include "util_lcd.h"
#include "basic_rf.h"
#include "per_test.h"
#include "hal_uart.h"
#include "util_buffer.h"
#include "sensor.h"
#include<string.h>

/***********************************************************************************
* CONSTANTS
*/
// Application states
#define IDLE                      0
#define TRANSMIT_PACKET           1
#define ZIGBEE                    2
#define         poly    0x1021          /* crc-ccitt mask */
/***********************************************************************************
* LOCAL VARIABLES
*/
static basicRfCfg_t basicRfConfig;
static perTestPacket_t txPacket;
static perTestPacket_t rxPacket;
static volatile uint8 appState;
static volatile uint8 appStarted;
static uint8 extdAddr[]={0xCD,0xAC,0x0C,0x25,0x20,0x11,0x00,0x01};
extern unsigned char command_rcvd;
extern basicRfRxInfo_t  rxi;
static atCmd_t cmd;
static pcBasedGatewaySensorDara_t payload;
static uint16 good_crc;
extern uint8 header[6];
/***********************************************************************************
* LOCAL FUNCTIONS
*/
static void appTransmitter();
static void appReceiver();
uint16 crc16_1(uint16 *data, uint8 length);
void update_good_crc(uint16 ch);
void augment_message_for_good_crc(void);

/***********************************************************************************
* @fn          appReceiver
*
* @brief       Application code for the receiver mode. Puts MCU in endless loop
*
* @param       basicRfConfig - file scope variable. Basic RF configuration data
*              rxPacket - file scope variable of type perTestPacket_t
*
* @return      none
*/
static void appReceiver()
{
    uint32 segNumber=0;
    int16 perRssiBuf[RSSI_AVG_WINDOW_SIZE] = {0},crc;    // Ring buffer for RSSI
    uint8 perRssiBufCounter = 0,i;                     // Counter to keep track of the
    // oldest newest byte in RSSI
    // ring buffer
    perRxStats_t rxStats = {0,0,0,0};
    int16 rssi;
    uint8 resetStats=FALSE;

#ifdef INCLUDE_PA
    uint8 gain;

    // Select gain (for modules with CC2590/91 only)
    gain =appSelectGain();
    halRfSetGain(gain);
#endif
#ifdef ZIGBEE
    // Initialize BasicRF
    //basicRfConfig.myAddr = RX_ADDR;
    if(basicRfInit(&basicRfConfig)==FAILED) {
      HAL_ASSERT(FALSE);
    }
    basicRfReceiveOn();
#endif

    // Main loop
    while (TRUE) {
#ifdef ZIGBEE
        while(!basicRfPacketIsReady());
        pc_based_gateway_rf_isr();
        if(basicRfReceive((uint8*)&payload, MAX_PAYLOAD_LENGTH, &rssi)>0) {
            halLedToggle(3);
            // Change byte order from network to host order
            //UINT32_NTOH(rxPacket.seqNumber);
            //segNumber = rxPacket.seqNumber;
           for(i=0;i<2;i++){
              while(!(UC1IFG & UCA1TXIFG));    // Wait for TX buffer ready to receive new byte
              UCA1TXBUF = header[i];
            }
             for(i=4;i<6;i++){
              while(!(UC1IFG & UCA1TXIFG));    // Wait for TX buffer ready to receive new byte
              UCA1TXBUF = header[i];
            }
            for(i=0;i<sizeof(payload)-2; i++){
              while(!(UC1IFG & UCA1TXIFG));    // Wait for TX buffer ready to receive new byte
              UCA1TXBUF = ((uint8 *)(&(payload)))[i];
             }
             /*crc = crc16_1((uint16 *)(&payload), 28);
             while(!(UC1IFG & UCA1TXIFG));    // Wait for TX buffer ready to receive new byte
             UCA1TXBUF = (uint8)((crc)&(0x00FF));
             while(!(UC1IFG & UCA1TXIFG));    // Wait for TX buffer ready to receive new byte
             UCA1TXBUF = (uint8)((crc>>8)&(0x00FF));
            if(!(crc - payload.crc)){
              halLedToggle(2);
            }*/
          }
#endif   
    }
}


/***********************************************************************************
* @fn          appTransmitter
*
* @brief       Application code for the transmitter mode. Puts MCU in endless
*              loop
*
* @param       basicRfConfig - file scope variable. Basic RF configuration data
*              txPacket - file scope variable of type perTestPacket_t
*              appState - file scope variable. Holds application state
*              appStarted - file scope variable. Controls start and stop of
*                           transmission
*
* @return      none
*/
static void appTransmitter(){
   
  uint8 n,i,j;
#ifdef ZIGBEE
  if(basicRfInit(&basicRfConfig)==FAILED) {
    HAL_ASSERT(FALSE);
  }
  
  halRfSetTxPower(cmd.txPower);
        
  basicRfReceiveOff();
        
  txPacket.seqNumber = 0;
        
  for(n = 0; n < 8; n++) {
    txPacket.padding[n] = basicRfConfig.extdAddr[n];
  }
#endif
   //j = sensorInit();
  while(1){
    halLedToggle(2);
  memcpy(payload.srcMacId, basicRfConfig.extdAddr, 8);
	//j = sensorInit();
    //sensorData(j, payload.sensorData);
    //sensorData(0xFF, payload.sensorData);
    //payload.crc = crc16_1((uint16 *)(&payload), 28);
    //for(n=0;n<20;n++){
      //while(!(UC1IFG & UCA1TXIFG));    // Wait for TX buffer ready to receive new byte
     // UCA1TXBUF = payload.sensorData[n];
   // }
#ifdef ZIGBEE
    basicRfSendPacket(cmd.destAddr, (uint8*)&payload, PACKET_SIZE-2);
#endif           
    TACCTL0 &= ~(1<<0);
    for(n=0;n < 3;n++){
      CCR0 = 32768;
      TACTL = TASSEL_1 + MC_1;	// SMCLK, upmode
      while(!(TACCTL0 & (1<<0)));
      TACCTL0 &= ~(1<<0);
    }
    //txPacket.seqNumber++;
  }
}


/***********************************************************************************
* @fn          main
*
* @brief       This is the main entry of the "PER test" application.
*
* @param       basicRfConfig - file scope variable. Basic RF configuration data
*              appState - file scope variable. Holds application state
*              appStarted - file scope variable. Used to control start and stop of
*              transmitter application.
*
* @return      none
*/
void main (void)
{
    uint8 n;
    //appState = IDLE;
    //appStarted = FALSE;
    WDTCTL = WDTPW + WDTHOLD;
    // Initialise board peripherals
    halBoardInit();
    halUartInit(HAL_UART_BAUDRATE_115200, 0);
    //halUartInit(HAL_UART_BAUDRATE_4800,0);
 #ifdef ZIGBEE   
    //while(!command_rcvd);
    //cmdBuffGet(&cmd);
 #endif   
    halLedSet(1);
    halLedSet(2);
    halLedSet(3);
    // Config basicRF
#ifdef ZIGBEE
    /*basicRfConfig.panId = cmd.panID; 
    basicRfConfig.ackRequest = FALSE;
    basicRfConfig.channel = cmd.channel;
    basicRfConfig.myAddr = cmd.srcAddr;
    memcpy(basicRfConfig.extdAddr, cmd.srcMacAddr, 8);*/
    
    basicRfConfig.panId = 0xCDAC; 
    basicRfConfig.ackRequest = FALSE;
    basicRfConfig.channel = 0x0F;
    basicRfConfig.myAddr = 0x007A;
    memcpy(basicRfConfig.extdAddr,extdAddr, 8);

    // Initalise hal_rf
    if(halRfInit()==FAILED) {
      HAL_ASSERT(FALSE);
    }
#endif
    //cmd.mode = MODE_TX;
    halLedClear(1);
    cmd.mode = MODE_TX;
    // Transmitter application
    if(cmd.mode == MODE_TX) {
        // No return from here
        appTransmitter();
    }
    // Receiver application
    else if(cmd.mode == MODE_RX) {
        // Initialize BasicRF
        // No return from here
        appReceiver();
    }
    // Role is undefined. This code should not be reached
    HAL_ASSERT(FALSE);
}

uint16 crc16_1(uint16 *data, uint8 length){
	
  uint16 i;
  good_crc = 0xffff;
  i = 0;
  
  while(i<length){
    update_good_crc(data[i]);
    i++;
  }
  augment_message_for_good_crc();
  return good_crc;
}

void update_good_crc(uint16 ch)
{
    uint16 i, v, xor_flag;

    /*
    Align test bit with leftmost bit of the message byte.
    */
    v = 0x80;

    for (i=0; i<8; i++)
    {
        if (good_crc & 0x8000)
        {
            xor_flag= 1;
        }
        else
        {
            xor_flag= 0;
        }
        good_crc = good_crc << 1;

        if (ch & v)
        {
            /*
            Append next bit of message to end of CRC if it is not zero.
            The zero bit placed there by the shift above need not be
            changed if the next bit of the message is zero.
            */
            good_crc= good_crc + 1;
        }

        if (xor_flag)
        {
            good_crc = good_crc ^ poly;
        }

        /*
        Align test bit with next bit of the message byte.
        */
        v = v >> 1;
    }
}

void augment_message_for_good_crc()
{
    uint16 i, xor_flag;

    for (i=0; i<16; i++)
    {
        if (good_crc & 0x8000)
        {
            xor_flag= 1;
        }
        else
        {
            xor_flag= 0;
        }
        good_crc = good_crc << 1;

        if (xor_flag)
        {
            good_crc = good_crc ^ poly;
        }
    }
}

/***********************************************************************************
  Copyright 2008 Texas Instruments Incorporated. All rights reserved.

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
  PROVIDED \93AS IS\94 WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED,
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
