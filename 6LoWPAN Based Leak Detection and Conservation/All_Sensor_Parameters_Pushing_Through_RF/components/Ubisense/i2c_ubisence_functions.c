#include "MSP430_i2c.h"
#include <stdlib.h>

char bus_read(unsigned char device_addr, unsigned char register_addr, unsigned char* register_data, unsigned char read_length, unsigned char reg_present)
{
	msp430_i2c_init(device_addr);
	if(reg_present)
	{
		msp430_i2c_write_bytes(device_addr,&register_addr,1,0);
		msp430_i2c_read_bytes(device_addr,register_data,read_length,1);
	}
	else
	{
		msp430_i2c_read_bytes(device_addr,register_data,read_length,1);
	}

	return read_length;
}

char bus_write(unsigned char device_addr, unsigned char register_addr, unsigned char* register_data, unsigned char write_length, unsigned char reg_present)
{
	int i,j=0;
	unsigned char *temp_reg;
	temp_reg= (unsigned char *)malloc(((sizeof(unsigned char)) * (write_length))+(sizeof(unsigned char)));
	if (reg_present) {*temp_reg=register_addr; j=1;}
	for(i=0;i<=write_length;++i)
	{
		*(temp_reg+i+j)=*(register_data+i);
	}

	msp430_i2c_init(device_addr);
	msp430_i2c_write_bytes(device_addr,temp_reg,write_length+j,1);
	free(temp_reg);

	return write_length;
}

void delay_msec (unsigned int delay)
{
	int i=0;
	TACCTL0 &= ~(1<<0);
	for(i=0;i < delay;i++)
	{
		CCR0 = 33;
		TACTL = TASSEL_1 + MC_1;	// SMCLK, upmode
		while(!(TACCTL0 & (1<<0)));
		TACCTL0 &= ~(1<<0);
	}
}

/* End of file */
