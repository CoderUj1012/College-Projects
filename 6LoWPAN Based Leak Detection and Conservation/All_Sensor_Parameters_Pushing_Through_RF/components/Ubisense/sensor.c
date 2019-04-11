
#include<stdio.h>
#include "ubisense.h"
//#include "MSP430_uart.h"
#include<msp430.h>
#include "sensor.h"
#include "MSP430_i2c.h"
#include "hal_types.h"

struct bmp180_t bmp180_data;
struct tsl2561_t tsl2561_data;
struct sht21_t sht21_data;
struct tsl26711_t tsl26711_data;

char bus_read(unsigned char device_addr, unsigned char register_addr, unsigned char* register_data, unsigned char read_length, unsigned char reg_present);
char bus_write(unsigned char device_addr, unsigned char register_addr, unsigned char* register_data, unsigned char write_length, unsigned char reg_present);
void delay_msec (unsigned int delay);

uint8 sensorInit(void){
  
  uint8 n;
  n = 0x00;
  
  if(!(findSensors(BMP180_I2C_ADDR))){
    bmp180_data.bus_read = bus_read;
    bmp180_data.bus_write = bus_write;
    bmp180_data.delay_msec = delay_msec;
    bmp180_init(&bmp180_data);
    n |= (1<<0); 
  } else {
    UCB0CTL1 |= UCTXSTP;
    n &= ~(1<<0);
  }
  if(!(findSensors(TSL2561_I2C_ADDR))){
    tsl2561_data.bus_write = bus_write;
    tsl2561_data.bus_read = bus_read;
    tsl2561_data.delay_msec = delay_msec;
    tsl2561_init(&tsl2561_data);
    n |= (1<<1);
  } else {
    UCB0CTL1 |= UCTXSTP;
    n &= ~(1<<1);
  }
  if(!(findSensors(SHT21_I2C_ADDR))){
    sht21_data.bus_write = bus_write;
    sht21_data.bus_read = bus_read;
    sht21_data.delay_msec = delay_msec;
    sht21_init(&sht21_data);
    n |= (1<<2)|(1<<3);
  } else {
    UCB0CTL1 |= UCTXSTP;
    n &= ~((1<<2)|(1<<3));
  }
  if(!(findSensors(TSL26711_I2C_ADDR))){
    tsl26711_data.bus_write = bus_write;
    tsl26711_data.bus_read = bus_read;
    tsl26711_data.delay_msec = delay_msec;
    tsl26711_init(&tsl26711_data);
    n |= (1<<4);
  } else {
    UCB0CTL1 |= UCTXSTP;
    n &= ~(1<<4);
  }
  return n;
}

uint8 findSensors(uint8 slaveAddr){
  
  uint8 Ack;
  
  msp430_i2c_init(slaveAddr);
  
  UCB0I2CIE  =  UCNACKIE;			  // NACK Interrupt Enable
  
  UCB0CTL1 |= UCTR + UCTXSTT + UCTXSTP;    // I2C start condition, I2C TX mode, I2C stop condition
  
  while( UCB0CTL1 & UCTXSTP );             // I2C stop condition sent?
  Ack = (UCB0STAT & UCNACKIFG);            // I2C start condition akd'd or not?	
  
  return Ack;
}

void sensorData(uint8 sensorNo, uint8 *sensorData){
  unsigned char raw_data[4],i;
  uint32 lux = 0,temperature=0,humidity=0;
  int raw_humi,raw_temp;
  float fhumi,ftemp;
  
  long pressure;
  unsigned long up;
  //unsigned long ut;
  //short bmp_temperature;
  uint16_t prxy;
  
  if(sensorNo & (1<<0)){
    up = bmp180_get_up();
    pressure = bmp180_get_pressure(up);
    sensorData[PRESS_POS] = PRESS_STRT_BYTE;
    for(i=0;i<4;i++){
      sensorData[PRESS_POS+1+i] = (((pressure)>>(i*8)) & 0x000000FF);
    }
  }
  if(sensorNo & (1<<1)){
    tsl2561_get_raw_light_intensity(raw_data);
    lux = tsl2561_get_lux_light_intensity(raw_data);
    sensorData[LGHT_POS] = LGHT_STRT_BYTE;
    for(i=0;i<4;i++){
      sensorData[LGHT_POS+1+i] = (((lux)>>(i*8)) & 0x000000FF);
    }
  }
  if(sensorNo & ((1<<2)|(1<<3))){
    raw_humi = sht21_get_raw_humidity();
    raw_temp = sht21_get_raw_temperature();
    fhumi = sht21_get_caliberated_humidity(raw_humi);
    ftemp = sht21_get_caliberated_temperature(raw_temp);
  
    temperature = (uint32) (ftemp*100);
    humidity = (uint32) (fhumi*100);
    
    sensorData[TEMP_POS ] = TEMP_STRT_BYTE;
    for(i=0;i<4;i++){
      sensorData[TEMP_POS +1+i] = (((temperature)>>(i*8)) & 0x000000FF);
    }
    
    sensorData[HUMID_POS] = HUMID_STRT_BYTE;
    for(i=0;i<4;i++){
      sensorData[HUMID_POS+1+i] = (((humidity)>>(i*8)) & 0x000000FF);
    }
    if(sensorNo & (1<<4)){
      prxy = tsl26711_get_proximity();
      sensorData[PRXY_POS] = PRXY_STRT_BYTE;
      for(i=0;i<2;i++){
        sensorData[PRXY_POS+1+i] = (((prxy)>>(i*8)) & 0x000000FF);
      }
    }
  }
}
