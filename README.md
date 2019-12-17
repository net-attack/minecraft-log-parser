# minecraft-log-parser
Small Php example with Mahatma Gantti
## Dependencies
To run localhost php server
```
sudo apt install php
```
## Install
```
git clone https://github.com/net-attack/minecraft-log-parser.git
cd minecraft-log-parser
```

### Add Gantti libary
```
git clone https://github.com/net-attack/gantti.git
```
or
```
.\getGantii
```

### Change Config 

Edit the index.php and change folder of
```
$minecraftParser = new MinecraftParser("logs/"); //Change to your server log folder containing *.log.gz
```

## Run

```
php -S localhost:8000
```
