/*  
 * Date: 07-Aug-2015
 * Revision: 1.0 
 *
 * Copyright (C) 2015 Centre for Development of Advanced Computing (CDAC), Bengaluru.
 *
 * MSP430 UART API
 *
 * Usage:  Application Programming Interface for UART initialisation and data read out
 * 
 * Author: Thajudheen K <thajudheenk@cdac.in>   
 *
 */

#include "MSP430_uart.h"

void msp430_uart_init(uint32_t baud_rate)
{
	WDTCTL = WDTPW + WDTHOLD;				// Switch of Watchdog
	UCA1CTL1 |= UCSWRST;            			// Hold peripheral in reset state 
	P3SEL |= 0xC0;                   			// Set P3.6--TX and P3.7--RX

	switch(baud_rate)
	{
		case MSP430_BAUD_2400:
			UCA1CTL1 |= UCSSEL_1;           			// CLK = SMCLK
			UCA1BR0 = 0x0D;                 			// 8MHz/115200 = 69 = 0x45
			UCA1BR1 = 0x00;
			UCA1MCTL |= UCBRS_6;
			break;

		case MSP430_BAUD_4800:
			UCA1CTL1 |= UCSSEL_1;		// CLK = ACLK
			UCA1BR1 = 0;			 
			UCA1BR0 = 0x06;			// 4800
			UCA1MCTL = UCBRS_6;	        // Modulation UCBRSx = 3            
			break;

		case MSP430_BAUD_9600:
			UCA1CTL1 |= UCSSEL_2;		// CLK = SMCLK
			DCOCTL = 0;
			BCSCTL1 = 0x8D;
			DCOCTL = 0x88;
			UCA1BR1 = 0X03;			 
			UCA1BR0 = 0x41;			 //9600 
			UCA1MCTL = UCBRS_2;	        // Modulation UCBRSx = 3            
			break;

		case MSP430_BAUD_38400:
			UCA1CTL1 |= UCSSEL_2;		// CLK = SMCLK
			DCOCTL = 0;
			BCSCTL1 = 0x8D;
			DCOCTL = 0x88;
			UCA1BR1 = 0X00;			 
			UCA1BR0 = 0xD0;			 //38400 
			UCA1MCTL = UCBRS_3;	        // Modulation UCBRSx = 3            
			break;

		case MSP430_BAUD_115200:
			UCA1CTL1 |= UCSSEL_2;		// CLK = SMCLK
			DCOCTL = 0;
			BCSCTL1 = 0x8D;
			DCOCTL = 0x88;
			UCA1BR1 = 0;			 
			UCA1BR0 = 0x45;			 //115200 
			break;

		default:
			UCA1CTL1 |= UCSSEL_2;           // CLK = SMCLK
			DCOCTL = 0;
			BCSCTL1 = 0x8D;
			DCOCTL = 0x88;
			UCA1BR1 = 0;
			UCA1BR0 = 0x45;                  //115200 
			break;
	}
	UCA1CTL1 &= ~UCSWRST;
}

void msp430_uart_write(uint8_t data)
{
	BCSCTL1 = 0x8D;
	while(!(UC1IFG & UCA1TXIFG));   // WAIT TILL THE BUFFER IS EMPTY
	UCA1TXBUF = data;
}

void msp430_uart_write_string(uint8_t *data_ptr)
{
	uint8_t i  = 0;
	uint8_t ch = data_ptr[i++];

	while (ch != '\0')
	{
		msp430_uart_write(ch);
		ch = data_ptr[i++];
	}
}

uint8_t msp430_uart_write_bytes(uint8_t *data_ptr,uint8_t size)
{
        uint8_t i  = 0, tsize ,ch;
	
	tsize = size;
	
        while (tsize != 0)
        {
                ch = data_ptr[i++];
                msp430_uart_write(ch);
		--tsize;
        }
	return size;
}


uint8_t msp430_uart_read(void)
{

}

uint8_t msp430_uart_read_bytes(uint8_t *data_ptr,uint8_t size)
{

}


/* End of file */
