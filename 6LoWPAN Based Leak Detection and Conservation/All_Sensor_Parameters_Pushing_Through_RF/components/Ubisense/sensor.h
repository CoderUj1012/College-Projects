
#ifndef SENSOR_H
#define SENSOR_H

#include "hal_types.h"
#define TEMP_STRT_BYTE  0xAA
#define PRESS_STRT_BYTE 0xBB
#define PRXY_STRT_BYTE  0xCC
#define LGHT_STRT_BYTE  0xDD
#define HUMID_STRT_BYTE 0xEE

enum sensor_data_position {
  TEMP_POS      =       0,
  PRESS_POS     =       5,
  PRXY_POS      =       10,
  LGHT_POS      =       15,
  HUMID_POS     =       20
};
uint8 findSensors(uint8 slaveAddr);
uint8 sensorInit(void);
void sensorData(uint8 sensorNo, uint8 *sensorData);

#endif