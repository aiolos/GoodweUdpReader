# GoodWe Solar Inverter read out

This application makes it possible to read out GoodWe Solar inverters through WiFi (without using a cloud solution).

## Usage
- Copy `inverters.php.dist` to `inverters.php` and set the IP-address(es) for you inverter(s) in `inverters.php`.
- Run `php read.php`
- Output of the inverter(s) in shown in the console
- When setting pv-output ApiKey and SystemId in `inverters.php`, the output will be send to PVOutput

## Next steps:
- Add option to send output to home automation solutions

## Requirements
- PHP, Version 7.3+
- A GoodWe inverter with minimal version x.y.14

## Acknowledgments 
A lot of information comes from [Tweakers forum](https://gathering.tweakers.net/forum/list_messages/1799239/last) and related links in that topic.
More specific posts: [this](https://gathering.tweakers.net/forum/list_message/67162456#67162456) and [this](https://gathering.tweakers.net/forum/list_message/67168926#67168926)
and this [repo](https://github.com/koen-lee/GoodweUDPToPvOutput)
