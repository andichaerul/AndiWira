var app = new Framework7({
  // App root element
  root: '#app',
  // App Name
  name: 'My App',
  // App id
  id: 'com.myapp.test',
  // Enable swipe panel
  smartSelect: {
    closeOnSelect:'true',
  },
  panel: {
    swipe: 'left',
  },
  // Add default routes
  routes: [
    {
      path:'/',
    redirect: '/about/',
    },
  
    {
      path: '/about/',
      url: 'about.html',

    },
    {
      path: '/one/',
      componentUrl: './one.html',
    },
    {
      path: '/result/',
      componentUrl: './result.html',
    },
    {
      path: '/cek-lokasi/',
      componentUrl: './cek-lokasi.html',
    },
    
    {
      path: '/seat/',
      componentUrl: './seat.html',
      options: {
        animate: false,
      },
    },
    {
      path: '/pax_form/',
      componentUrl: './pax_form.html',
    },
    {
      path: '/biodata/',
      componentUrl: './biodata.html',
    },    
  ],
  calendar: {
    url: 'calendar/',
    dateFormat: 'yyyy/dd/mm',
  },
});
var $$ = Dom7;
var date = new Date();
// add a day
var sasa = date.setDate(date.getDate() + 1);
var mainView = app.views.create('.view-main', {
  stackPages : 'true',
});
var popup = app.popup.create({
});
var calendarDefault = app.calendar.create({
  dateFormat: 'yyyy/mm/dd',
  inputEl: '#calendar-default',
  //disabled: {
  //      from: new Date(0, 1, 1),
  //      to: new Date(sasa)
  //  },
    closeOnSelect:'true',
});

// $("#splash-screen").delay(3000).fadeOut();
// app.preloader.show(); 
    // if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(showPosition);
    // } else { 
    // }
    // function showPosition(position) {
    // document.getElementById("mylocation").value = position.coords.longitude +","+ position.coords.latitude;
    // }
    // $(document).ready(function(){
    //     var delay = 1000;
    //     setTimeout(function() {
    //       var mylocation = $("#mylocation").val();
    //       var reportlocation = $("#reportlocation").val();
    //       console.log(mylocation);
    //       $("#div1").load("https://birautama.com/genetika/wira/AndiWira/?dari="+mylocation+"&tujuan="+reportlocation+"");
    //       }, 2000);
    // app.preloader.hide();    
    // });  
          

 
var toastBottom = app.toast.create({
  text: 'Kasus anda belum ditentukan',
  closeTimeout: 2000,
});

$$('#lapor').on('click', function(){
  var kasus= document.getElementById("kasus").value;   
    
  if (kasus==null || kasus=="")
        {
            toastBottom.open();
            return false;
        }    
  else{
     mainView.router.navigate('/result/');
  }                      
});






