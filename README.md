Video Thumbnailer
===

Deploy with `docker-compose` or however you want.

URL parameters are:
 * url:  The publically available video file
 * s:  the second into the video that the screenshot should be taken (defaults to 2)
 * fmt:  format of the image, either png, jpg, or jpeg (defaults to jpg)


Response
===
The response will be the binary output of the screenshot image.  The image is currently not scaled.

Headers returned include:
 * Content-disposition: attachment; filename="{unique id.png}"
 * Content-type: [ image/png | image/jpeg ]

Example
===
```
 curl  -X GET "http://127.0.0.1:9999/index.php?url=https://github.com/markkimsal/video-thumbnailer/raw/master/fixtures/ISS-live-stream-earth-from-space-2020-05-08.mp4&s=3.8" --output test_iss_earth.jpg
```

Security
===
This is essentially an open proxy, so secure it with:
 * firewall rules
 * reverse proxy
 * docker swarm networks
 * k8s
