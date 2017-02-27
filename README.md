# Allcall


View the full docs at <https://allcall.io>.

## What is Allcall?
Allcall is an open-source project that leverages modern web technologies to provide a web-based interface for playback of audio alerts across multiple physical locations.

## What is Allcall used for?
Allcall is useful for school campuses, dormitories, businesses, and other spaces that require the ability to play an audio file on multiple audio systems from one interface. This is commonly used for lockdowns, evacuations, and other emergency instructions, but could be applied for many other purposes as well.

## How does Allcall work?
Allcall consists of a single control server, and many nodes each connected to an audio system. A user can login to the Allcall interface, select an audio file, and then select which nodes to playback on. This will initiate a secure request to each node to begin playback, and then show a live status of which nodes have successfully responded to the request.

### About The Server
The control server uses PHP, and is built with Laravel. The server is responsible for providing the user interface, maintaining a database of nodes and audio alerts, and initiating and stopping playback on nodes.

### About Nodes
The node client uses Python, and is built with Flask. The client is responsible for providing a physical connection for audio to playback on a typical public announcement system, and is usually installed on a small computer such as a Raspberry Pi. We recommend using Resin.io for node management.