
#include<stdio.h>
#include<string.h>
#include<msp430f2618.h>
#include "hal_led.h"
#include "hal_int.h"
#include "hal_board.h"
#include "hal_rf.h"
#include "hal_assert.h"
#include "util_buffer.h"
#include "basic_rf.h"
#include "per_test_menu.h"
#include "per_test.h"
#include "hal_uart.h"
#include "hal_cc2520.h"
#include "cmote-config.h"
#include "sensor.c"

static basicRfCfg_t basicRfConfig;
static perTestPacket_t rxPacket;
extern uint8 header[6];
uint8_t *payload;

int putchar(int c) {

    while(!(UC1IFG & UCA1TXIFG));   // WAIT TILL THE BUFFER IS EMPTY
	UCA1TXBUF = c;
    return c;
}

static void appReceiver(void);

int main(void){

    WDTCTL = WDTPW + WDTHOLD;

    halBoardInit();
    halUartInit(HAL_UART_BAUDRATE_4800, 0);

    halLedSet(1);
    halLedSet(2);
    halLedSet(3);

    basicRfConfig.panId = PAN_ID; 
    basicRfConfig.ackRequest = FALSE;
    basicRfConfig.channel = CHANNEL;
    basicRfConfig.myAddr = RX_ADDR;

    if(halRfInit()==FAILED) {
        HAL_ASSERT(FALSE);
    }
    
    halLedClear(1);

    halRfSetTxPower(TX_POWR);

    appReceiver();
    return 0;
}

static void appReceiver(void){
    
	uint8_t i;
    uint32_t data;
    int16 rssi;
    	
    // Initialize BasicRF
    basicRfConfig.myAddr = RX_ADDR;
    if(basicRfInit(&basicRfConfig)==FAILED) {
        HAL_ASSERT(FALSE);
    }
    
	basicRfReceiveOn();


    // Main loop
   	while (TRUE) {
        while(!basicRfPacketIsReady());
		
        pc_based_gateway_rf_isr();
		halLedClear(2);        
		if(basicRfReceive((uint8*)&rxPacket, MAX_PAYLOAD_LENGTH, &rssi)>0) {
            halLedToggle(3);
            payload = (uint8_t *)(&rxPacket);
		long count = 0, lphr=0;
		count = rxPacket.seqNumber;
		int i=0;
		for(i=1; i<60; i++)
			count += count;
		printf("%d - ",rxPacket.seqNumber);
		printf("%ld - ",count);
		lphr = (count*60) / 7.5;
		printf("%ld", lphr);
		printf(" L/hr\n");
            /*for(i=0;i<2;i++){
                while(!(UC1IFG & UCA1TXIFG));    
              	UCA1TXBUF = header[i];
            }
            for(i=4;i<6;i++){
                while(!(UC1IFG & UCA1TXIFG));    
              	UCA1TXBUF = header[i];
            }
            for(i=0;i<29; i++){
                while(!(UC1IFG & UCA1TXIFG));    
              	UCA1TXBUF = payload[i];
            }*/
		/*
            data = 0x00;
            for(i=0;i<4;i++){
                data |= (uint32_t)((uint32_t)((payload[TEMP_POS+1+i+4]))<<(i*8));
            }
            printf("\n\r--------------------UbiSense Data--------------------\n\r");
            printf("Source Node ID: 0x%02X%02X\n\r",header[5],header[4]);
            printf("Temperature: %d.%d\n\r",(int)data/100,(int)data%100);
            data = 0x00;
            for(i=0;i<4;i++){
                data |= (uint32_t)((uint32_t)((payload[PRESS_POS+1+i+4]))<<(i*8));
            }
            printf("Pressure: %lu.%d\n\r",(long)data/100,(int)data%100);
            data = 0x00;
            for(i=0;i<2;i++){
                data |= (uint32_t)((uint32_t)((payload[PRXY_POS+1+i+4]))<<(i*8));
            }
            printf("Proximity: %d\n\r",(int)data);
            data = 0x00;
            for(i=0;i<4;i++){
                data |= (uint32_t)((uint32_t)((payload[LGHT_POS+1+i+4]))<<(i*8));
            }
            printf("Light Intensity: %d\n\r",(int)data);
            data = 0x00;
            for(i=0;i<4;i++){
                data |= (uint32_t)((uint32_t)((payload[HUMID_POS+1+i+4]))<<(i*8));
            }
            printf("Humidity: %d.%d\n\r",(int)data/100,(int)data%100);
		*/
        }
    }
}
