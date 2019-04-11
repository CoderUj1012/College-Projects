/*  
 * Date: 07-Aug-2015
 * Revision: 2.0 
 *
 * Copyright (C) 2015 Centre for Development of Advanced Computing (CDAC), Bengaluru.
 *
 * MSP430 I2C API
 *
 * Usage:  Application Programming Interface for I2C initialisation and data read out
 * 
 * Author: Thajudheen K <thajudheenk@cdac.in>   
 *
 */

#include "MSP430_i2c.h"

void msp430_i2c_init(uint8 dev_addr)
{
	//WDTCTL = WDTPW + WDTHOLD;                 // Stop WDT
	P3SEL |= 0x06;                            // Assign I2C pins to USCI_B0	
	UCB0CTL1 |= UCSWRST;                      // Enable SW reset
	UCB0CTL0 = UCMST + UCMODE_3 + UCSYNC;     // I2C Master, synchronous mode
	UCB0CTL1 = UCSSEL_2 + UCSWRST;            // Use SMCLK, keep SW reset
	BCSCTL1 = 0x00;
	UCB0BR0 = 12;                             // fSCL = SMCLK/12 = ~100kHz
	UCB0BR1 = 0;
	UCB0I2CSA = dev_addr;                         // Slave Address is 069h
	UCB0CTL1 &= ~UCSWRST;                     // Clear SW reset, resume operation
}

uint8 msp430_i2c_read_bytes(uint8 address, uint8 *data_ptr, uint8 data_length, uint8 issue_stop_condition)
{	
	uint8 d_len,dcount=0;

        if(data_length < 1) { return 0;}
        d_len = data_length;

        IFG2 &= ~(UCB0RXIFG);                           // Clearing UCB0RXIFG flag
        UCB0CTL1 &= ~(UCTR);                     	// I2C RX
        UCB0CTL1 |= UCTXSTT;                     	// start condition
       /* Delay may be required here */
	if(UCB0STAT & UCNACKIFG){ UCB0CTL1 |= UCTXSTP; return 0; } // If NACK received cancelling I2C transfer
        do
        {
                while(!(IFG2 & UCB0RXIFG));             // Wait till txbuffer is free
                IFG2 &= ~(UCB0RXIFG);                   // Clearing UCB0TXIFG flag
                data_ptr[dcount] = UCB0RXBUF;
                ++dcount; --d_len;
        }
        while(d_len);

        UCB0CTL1 |= UCTXSTP;                    //  stop condition
        while (UCB0CTL1 & UCTXSTP);             // Ensure stop condition got sent
	
	return data_length;	
}


uint8 msp430_i2c_write_bytes(uint8 address, uint8 *data_ptr, uint8 data_length, uint8 issue_stop_condition)
{
	uint8 d_len,dcount=0;
	
	if(data_length < 1) { return 0;}
	d_len = data_length;
		
	IFG2 &= ~(UCB0TXIFG);				// Clearing UCB0TXIFG flag
	UCB0CTL1 |= UCTR + UCTXSTT;			// I2C TX, start condition
       /* Delay may be required here */
	if(UCB0STAT & UCNACKIFG){ UCB0CTL1 |= UCTXSTP; return 0; } // If NACK received cancelling I2C transfer
	do
	{
		while(!(IFG2 & UCB0TXIFG));		// Wait till txbuffer is free
		IFG2 &= ~(UCB0TXIFG);			// Clearing UCB0TXIFG flag
		UCB0TXBUF = data_ptr[dcount];
		++dcount; --d_len;
       		/* Delay may be required here */
		if(UCB0STAT & UCNACKIFG){ UCB0CTL1 |= UCTXSTP; return 0; } // If NACK received cancelling I2C transfer
 	}
	while(d_len);
	
	while(!(IFG2 & UCB0TXIFG));             	// Wait till txbuffer is free
        IFG2 &= ~(UCB0TXIFG);                           // Clearing UCB0TXIFG flag
        
	if(issue_stop_condition)
	{
		UCB0CTL1 |= UCTXSTP;                    //  stop condition
		while (UCB0CTL1 & UCTXSTP);             // Ensure stop condition got sent
	}
	
	return data_length; 
}

/* End of file */
