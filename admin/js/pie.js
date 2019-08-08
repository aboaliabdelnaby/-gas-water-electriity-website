$(function(){
    
    show1();
    show2();
    show3();
    
    ctx1 = $("#pie-chartcanvas-1");
    ctx2 = $("#pie-chartcanvas-2");
    ctx3 = $("#pie-chartcanvas-3"); 
    

function show1(){
    
        var options = {
  responsive: true,
  title: {
    display: true,
    position: "top",
    text: "تقييم المستخدمين لخدمة الكهرباء",
    fontSize: 15,
    fontColor: "#111"
  },
  legend: {
    display: false,
    position: "left",
    labels: {
      fontColor: "#333",
      fontSize: 10,
        
    }
  }
};
         $.ajax({
       'type':'post',
       'url':'pie.php',
       'data':{'e':'go'},
       'success':function(response){
           var comp=JSON.parse(response);
           var label = [];
            var data = [];
         for(i=0;i<comp.length;i++){
             label.push(" تقييم "+comp[i]['a']);
             data.push(comp[i]['b']);
         } 
    
   var data1 = {
    labels:label,
    datasets: [
      {
        label: "TeamA Score",
        data: data,
        backgroundColor: [
          "#DEB887",
          "#A9A9A9",
          "#DC143C",
          "#F4A460",
          "#2E8B57"
        ],
        borderColor: [
          "#CDA776",
          "#989898",
          "#CB252B",
          "#E39371",
          "#1D7A46"
        ],
        borderWidth: [1, 1, 1, 1, 1]
      }
    ]
  };
           
      var chart1 = new Chart(ctx1, {
    type: "pie",
    data: data1,
    options: options
  });
     },
       'error':function(error){
           alert(error);
       }
   });
      }
    
    

    
    
    
function show2(){
    
        var options = {
  responsive: true,
  title: {
    display: true,
    position: "top",
    text: "تقييم المستخدمين لخدمة المياه",
    fontSize: 15,
    fontColor: "#111"
  },
  legend: {
    display: false,
    position: "left",
    labels: {
      fontColor: "#333",
      fontSize: 10,
        
    }
  }
};
         $.ajax({
       'type':'post',
       'url':'pie.php',
       'data':{'w':'go'},
       'success':function(response){
           var comp=JSON.parse(response);
           var label = [];
            var data = [];
         for(i=0;i<comp.length;i++){
             label.push(" تقييم "+comp[i]['a']);
             data.push(comp[i]['b']);
         } 
    
   var data1 = {
    labels:label,
    datasets: [
      {
        label: "TeamA Score",
        data: data,
        backgroundColor: [
          "#DEB887",
          "#A9A9A9",
          "#DC143C",
          "#F4A460",
          "#2E8B57"
        ],
        borderColor: [
          "#CDA776",
          "#989898",
          "#CB252B",
          "#E39371",
          "#1D7A46"
        ],
        borderWidth: [1, 1, 1, 1, 1]
      }
    ]
  };
           
      var chart1 = new Chart(ctx2, {
    type: "pie",
    data: data1,
    options: options
  });
     },
       'error':function(error){
           alert(error);
       }
   });
      }
    
    
    
    function show3(){
    
        var options = {
  responsive: true,
  title: {
    display: true,
    position: "top",
    text: "تقييم المستخدمين لخدمة الغاز",
    fontSize: 15,
    fontColor: "#111"
  },
  legend: {
    display: false,
    position: "left",
    labels: {
      fontColor: "#333",
      fontSize: 10,
        
    }
  }
};
         $.ajax({
       'type':'post',
       'url':'pie.php',
       'data':{'g':'go'},
       'success':function(response){
           var comp=JSON.parse(response);
           var label = [];
            var data = [];
         for(i=0;i<comp.length;i++){
             label.push(" تقييم "+comp[i]['a']);
             data.push(comp[i]['b']);
         } 
    
   var data1 = {
    labels:label,
    datasets: [
      {
        label: "TeamA Score",
        data: data,
        backgroundColor: [
          "#DEB887",
          "#A9A9A9",
          "#DC143C",
          "#F4A460",
          "#2E8B57"
        ],
        borderColor: [
          "#CDA776",
          "#989898",
          "#CB252B",
          "#E39371",
          "#1D7A46"
        ],
        borderWidth: [1, 1, 1, 1, 1]
      }
    ]
  };
           
      var chart1 = new Chart(ctx3, {
    type: "pie",
    data: data1,
    options: options
  });
     },
       'error':function(error){
           alert(error);
       }
   });
      }
    
    
    
    
});