<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('266f14abac7532110319', {
      cluster: 'eu'
    });

    var channel = pusher.subscribe('orders{{Auth::user()->id}}');
    channel.bind('create', function(data) {
       
       // Print the message in the 'data' object using JavaScript
       console.log('Received message: ' + data.message);
        
        // Optionally, you can show it as an alert or on the page
        alert('Message: ' + data.message);
      
    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body>