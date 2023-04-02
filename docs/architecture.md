# THEA Server Architecture

![Architecture](images/THEA-Architeture.png?raw=true "THEA Architecture")

The tool is composed of two key components: THEA Mobile Application and THEA Server.
The THEA mobile application is installed on the subject/driver’s mobile phone. During 
installation the driver is assigned a unique id.  The mobile application tracks the driver’s 
movement by collecting timestamped GPS coordinates as has he/she moves.  The collected 
location information is sent to the THEA Server. 

The THEA Server is composed of four subcomponents: the API Service, data persistence 
service, Hotspot detection engine, prediction and validation engine, and a routing engine. 

The API service enables communication between the THEA Server and the mobile application. 
It also enables external systems such as laboratory management systems to send test 
results and received data back. All communication with the THEA Server and API Service 
are through encrypted connections.

The THEA Server receives the location information form the drivers through the API service. 
It stores driver test results which can be added manually or automatically collected from 
an external test result system via the API service.  

The GPS location data is confined to the road network by using the routing engine. The 
routing engine takes each GPS location and translates it into a point on the nearest road 
segment.

The THEA Server takes the GPS locations and test results and identifies infection hotspots  
using the Hotspot detection engine.  The service runs a clustering algorithm that considers 
the time, distance and location of the driver to identify potential hotspots.
