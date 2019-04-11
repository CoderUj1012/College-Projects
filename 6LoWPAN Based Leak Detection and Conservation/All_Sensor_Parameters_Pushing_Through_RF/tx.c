
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
#include "sensor.h"
#include "cmote-config.h"

static basicRfCfg_t basicRfConfig;
static perTestPacket_t txPacket;
extern uint8 header[6];

static void appTransmitter(void);
static void wait(uint8 sec);


void toggleMain(void);
volatile int count = 0;
volatile int flag = 0;

int putchar(int c) {

    while(!(UC1IFG & UCA1TXIFG));   // WAIT TILL THE BUFFER IS EMPTY
	UCA1TXBUF = c;
    return c;
}


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
    basicRfConfig.myAddr = TX_ADDR;

    if(halRfInit()==FAILED) {
        HAL_ASSERT(FALSE);
    }
    
    halLedClear(3);

    halRfSetTxPower(TX_POWR);
	toggleMain();
    //appTransmitter();
    return 0;
}

static void appTransmitter(void){
	
	uint8 n,j;

    if(basicRfInit(&basicRfConfig)==FAILED) {
        HAL_ASSERT(FALSE);
     }   
    basicRfReceiveOff();
    txPacket.seqNumber = count;
    for(j=0; j<25; j++)
	txPacket.padding[j] = 'a';
    //while(1)
	{

      //  wait(1);
		
        halLedToggle(2);
		
		//j = sensorInit();    		
        //sensorData(j, txPacket.padding);
		basicRfSendPacket(RX_ADDR, (uint8*)&txPacket, sizeof(txPacket));
        txPacket.seqNumber++;
    }
}

static void wait(uint8 sec){

	uint8 n;
	TACCTL0 &= ~(1<<0);
	for(n=0;n < sec;n++){
		CCR0 = 32768;
		TACTL = TASSEL_1 + MC_1;	// SMCLK, upmode
		while(!(TACCTL0 & (1<<0)));
		TACCTL0 &= ~(1<<0);
      }
}


void toggleMain(void) { 

	WDTCTL = WDTPW + WDTHOLD; // Stop watchdog timer
	
	//P5DIR = BIT4;
	//P5OUT = BIT4;
	
	P2IE |= 0x10; // P2.4 interrupt enabled
	P2IES |= 0x10; // P2.4 Hi/lo edge
	P2IFG &= ~0x10; // P2.4 IFG cleared
	_BIS_SR(LPM0_bits + GIE);
	//printf("ROFL\t");
	while(1) {
		P2IE |= 0x10; // P2.4 interrupt enabled
		P2IES |= 0x10; // P2.4 Hi/lo edge
		P2IFG &= ~0x10; // P2.4 IFG cleared
		
		_BIS_SR(LPM0_bits); // Enter LPM4 w/interrupt
		wait(2);
		printf("Round Over ");
		//_BIC_SR_IRQ(LPM0_bits);
		//LPM0_EXIT;
		//if(count==0)	flag=0;
		//count = 0;		
		
    }
} 


// Timer0 A0 interrupt service routine
/*
#pragma vector=TIMER0_A0_VECTOR
__interrupt void TIMER0_A0_ISR(void) {
	//wait(2);
	LPM0_EXIT;
	count=0;
	halLedToggle(1);
}
*/

// Port 2 interrupt service routine 
#pragma vector=PORT2_VECTOR
__interrupt void Port_2(void) { 
	count++; // Incrementing the counter when ever an interrupt comes
	if(count%2 == 0)
	{
		//flag = 1;
		halLedClear(1);
		printf("%d\n",count);
		//if(!flag)	
			appTransmitter();
		//LPM0_EXIT;
		flag = 1;
		//_BIC_SR_ISQ(LPM0_bits);
	}
	P2IFG &= ~0x10; // P1.4 IFG cleared
}


