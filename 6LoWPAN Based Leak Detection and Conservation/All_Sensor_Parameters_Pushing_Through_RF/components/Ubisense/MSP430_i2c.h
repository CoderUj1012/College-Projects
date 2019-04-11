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

#include <stdio.h>
#include <msp430.h>
#include "hal_types.h"
//#define uint8_t uint8

void msp430_i2c_init(uint8);
uint8 msp430_i2c_read_bytes(uint8, uint8*, uint8, uint8);
uint8 msp430_i2c_write_bytes(uint8, uint8*, uint8, uint8);

/* End of file */
