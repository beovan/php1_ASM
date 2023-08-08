function hienThi() {
    if (navigator.geolocation) {
        // Request permission to access user's location
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
      } else {
        console.log("Geolocation is not supported.");
      }
      
      function successCallback(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;
      
        console.log("Latitude: " + latitude);
        console.log("Longitude: " + longitude);
      
        // Display the location on a map
        const mapDiv = document.getElementById("map");
        mapDiv.src = `https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3892.056195570977!2d${longitude}!3d${latitude}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTLCsDQyJzM1LjEiTiAxMDjCsDA0JzI5LjgiRQ!5e0!3m2!1sen!2sus!4v1685766211010!5m2!1sen!2sus`;
      }
      
      function errorCallback(error) {
        switch (error.code) {
          case error.PERMISSION_DENIED:
            console.log("User denied the request for geolocation.");
            break;
          case error.POSITION_UNAVAILABLE:
            console.log("Location information is unavailable.");
            break;
          case error.TIMEOUT:
            console.log("The request to get user location timed out.");
            break;
          case error.UNKNOWN_ERROR:
            console.log("An unknown error occurred.");
            break;
        }
      }
      
}