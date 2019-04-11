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

#include <stdint.h>
#include <msp430.h>

#define MSP430_BAUD_2400 2400
#define MSP430_BAUD_4800 4800
#define MSP430_BAUD_9600 9600
#define MSP430_BAUD_38400 38400
#define MSP430_BAUD_115200 115200 

void msp430_uart_init(uint32_t);
void msp430_uart_write(uint8_t);
void msp430_uart_write_string(uint8_t*);
uint8_t msp430_uart_write_bytes(uint8_t*, uint8_t);
uint8_t msp430_uart_read(void);
uint8_t msp430_uart_read_bytes(uint8_t*, uint8_t);

/* End of file */
