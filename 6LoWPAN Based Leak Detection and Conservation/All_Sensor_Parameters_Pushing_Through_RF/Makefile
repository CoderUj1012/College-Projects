
GCC_PREFIX = msp430
CC = gcc 
TARGET = $(TEST).c
OBJECT = $(TEST).co
LIBRARY	= lib.a
BOARD = msp430f2618 
BUILD = $(TEST)
OPTI = -Os
FLASHER = cmote-bsl
ALL_PATHS = -I./components/assembly/ -I./components/basicrf/ -I./components/common/ -I./components/common/msp430/ -I./components/radios/cc2520/ -I./components/targets/interface/ -I./components/targets/srf05_ccmsp2618/ -I./components/utils/ -I./components/Ubisense/
DEV = /dev/ttyUSB2
include Makefile.test
MAKEFLAGS = --silent

all:
	-@rm -f Makefile.test
	@echo >Makefile.test "TEST = $(TEST)"
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/assembly/assy_ccmsp2618_cc2520em.c  -o assy_ccmsp2618_cc2520em.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/basicrf/basic_rf.c -o basic_rf.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/basicrf/basic_rf_security.c -o basic_rf_security.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/common/hal_int.c -o hal_int.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/radios/cc2520/hal_cc2520.c  -o hal_cc2520.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/radios/cc2520/hal_rf.c  -o hal_rf.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/radios/cc2520/hal_rf_security.c  -o hal_rf_security.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/radios/cc2520/hal_rf_util.c  -o hal_rf_util.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/targets/srf05_ccmsp2618/hal_assert.c -o hal_assert.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/targets/srf05_ccmsp2618/hal_board.c -o hal_board.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/targets/srf05_ccmsp2618/hal_button.c -o hal_button.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/targets/srf05_ccmsp2618/hal_digio.c -o hal_digio.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/targets/srf05_ccmsp2618/hal_joystick.c -o hal_joystick.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/targets/srf05_ccmsp2618/hal_lcd.c -o hal_lcd.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/targets/srf05_ccmsp2618/hal_led.c -o hal_led.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/targets/srf05_ccmsp2618/hal_mcu.c -o hal_mcu.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/targets/srf05_ccmsp2618/hal_timer_32k.c -o hal_timer_32.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/targets/srf05_ccmsp2618/hal_uart.c -o hal_uart.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/utils/util.c -o util.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/utils/util_buffer.c -o util_buffer.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/utils/util_lcd.c -o util_lcd.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/utils/util_uart.c -o util_uart.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/Ubisense/i2c_ubisence_functions.c -o i2c_ubisence_functions.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/Ubisense/MSP430_i2c.c -o MSP430_i2c.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/Ubisense/MSP430_uart.c -o MSP430_uart.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/Ubisense/ubisense.c -o ubisense.o
	$(GCC_PREFIX)-$(CC) $(OPTI) -mmcu=msp430f2618   -I. $(ALL_PATHS) -c ./components/Ubisense/sensor.c -o sensor.o
	$(GCC_PREFIX)-ar rcf $(LIBRARY) *.o
	rm -f *.o
	$(GCC_PREFIX)-$(CC) -Os -Wall -mmcu=msp430f2618   -I. $(ALL_PATHS) -c $(TEST).c -o $(TEST).co
	$(GCC_PREFIX)-$(CC) -Wl,--defsym -Wl,__P1SEL2=0x0041 -Wl,--defsym -Wl,__P5SEL2=0x0045 -mmcu=msp430f2618 -Wl,--gc-sections,--undefined=_reset_vector__,--undefined=InterruptVectors,--undefined=_copy_data_init__,--undefined=_clear_bss_init__,--undefined=_end_of_init__  $(TEST).co  $(LIBRARY)  -o $(TEST).cmote
	$(GCC_PREFIX)-objcopy $(TEST).cmote -O ihex $(TEST).ihex
	@echo "Successfully Build"
flash:
	$(FLASHER) --cmote -c $(DEV) -r -I -p $(TEST).ihex

clean:
	rm -f  *.o *.a *.co *.cmote *.ihex *~
