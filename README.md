# pi_api
Simple PHP apis for various Raspberry Pi projects

## gpio
For reading gpio pins over http. Uses WiringPi gpio utility. Responds in json.

Example query: http://localhost/gpio/?a=readPin&pin=0
    {
      "status": "OK",
      "data": "0"
    }


## temp
For reading DS18B20 sensor over http. Uses w1-gpio & w1-therm kernel modules. Responds in json.

Example query: http://localhost/temp/?a=getTemp
    {
      "status": "OK",
      "data": 18.75
    }
