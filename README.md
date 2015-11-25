# pi_api
Simple PHP apis for various Raspberry Pi projects

## gpio
For reading gpio pins over http. Uses WiringPi gpio utility. Responds in json.

Example query: http://localhost/gpio/?a=readPin&pin=0
```
{
  "status": "OK",
  "data": "0"
}
```

## temp
For reading DS18B20 sensor over http. Uses w1-gpio & w1-therm kernel modules. Responds in json.

Example query: http://localhost/temp/?a=getTemp
```
{
  "status": "OK",
  "data": 18.75
}
```

## humidity
For reading DHT11 sensor over http. Uses a python script. Responds in json.

Example query: http://localhost/humidity/?a=getHumidity
```
{
  "status": "OK",
  "data": 45
}
```

## stream
For playing a web radio stream using mplayer. Responds in json.

Example query: http://localhost/stream/?a=playStream&stream=http://nectarine.from-de.com/necta192
```
{
  "status": "OK"
}
```

## folistop
For getting bus stop timetables from föli.fi. Respinds in json.

Example query: http://localhost/folistop/?a=getStop&stop=123
```
{
   "status":"OK",
   "stop":"Polttohautaamo",
   "data":[
      {
         "time":"2 min",
         "line":"2A",
         "dest":"Kohmo"
      },
      {
         "time":"14:42",
         "line":"2",
         "dest":"Kohmo"
      },
      {
         "time":"14:44",
         "line":"P2",
         "dest":"Huhkola"
      },
      {
         "time":"14:52",
         "line":"2A",
         "dest":"Kohmo"
      },
      {
         "time":"15:00",
         "line":"P2",
         "dest":"Kauppatori"
      },
      {
         "time":"15:02",
         "line":"2",
         "dest":"Kohmo"
      },
      {
         "time":"15:12",
         "line":"2A",
         "dest":"Kohmo"
      },
      {
         "time":"15:22",
         "line":"2",
         "dest":"Kohmo"
      },
      {
         "time":"15:32",
         "line":"2A",
         "dest":"Kohmo"
      },
      {
         "time":"15:42",
         "line":"2",
         "dest":"Kohmo"
      }
   ]
}
```
