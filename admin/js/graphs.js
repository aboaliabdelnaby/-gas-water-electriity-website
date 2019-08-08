 $(function(){
         $(".e").html(show1());
         $(".w").html(show2());
        $(".g").html(show3());
      function show1(){
         $.ajax({
       'type':'post',
       'url':'graphs.php',
       'data':{'e':'go'},
       'success':function(response){
          
           val=['يناير' , 'فبراير','مارس','ابريل','مايو','يونيوا','يوليوا','اغسطس','سبتمبر','اكتوبر','نوفمبر','ديسمبر'];
           var comp=JSON.parse(response);
           var month = [];
            var ncomp = [];
         for(i=0;i<comp.length;i++){
             month.push(val[(comp[i]['a'])-1]);
             ncomp.push(comp[i]['b']);
         }
          var chartdata = {
                labels: month,
                datasets: [
                    {
                        label: 'عدد الشكاوي في كل شهر في هذة السنة',
                        backgroundColor: 'RGB(0, 192 , 239)',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: ncomp
                    }
                ]
            };

            var graphTarget = $("#graphCanvas1");

            var barGraph = new Chart(graphTarget, {
                type: 'bar',
                data: chartdata
            });
           
       
       },
       'error':function(error){
           alert(error);
       }
   });
      }
 function show2(){
         $.ajax({
       'type':'post',
       'url':'graphs.php',
       'data':{'w':'go'},
       'success':function(response){
          
           val=['يناير' , 'فبراير','مارس','ابريل','مايو','يونيوا','يوليوا','اغسطس','سبتمبر','اكتوبر','نوفمبر','ديسمبر'];
           var comp=JSON.parse(response);
           var month = [];
            var ncomp = [];
         for(i=0;i<comp.length;i++){
             month.push(val[(comp[i]['a'])-1]);
             ncomp.push(comp[i]['b']);
         }
          var chartdata = {
                labels: month,
                datasets: [
                    {
                        label: 'عدد الشكاوي في كل شهر في هذة السنة',
                        backgroundColor: 'RGB(0, 166 , 90)',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: ncomp
                    }
                ]
            };

            var graphTarget = $("#graphCanvas2");

            var barGraph = new Chart(graphTarget, {
                type: 'bar',
                data: chartdata
            });
           
       
       },
       'error':function(error){
           alert(error);
       }
   });
      }
    
 function show3(){
         $.ajax({
       'type':'post',
       'url':'graphs.php',
       'data':{'g':'go'},
       'success':function(response){
          
           val=['يناير' , 'فبراير','مارس','ابريل','مايو','يونيوا','يوليوا','اغسطس','سبتمبر','اكتوبر','نوفمبر','ديسمبر'];
           var comp=JSON.parse(response);
           var month = [];
            var ncomp = [];
         for(i=0;i<comp.length;i++){
             month.push(val[(comp[i]['a'])-1]);
             ncomp.push(comp[i]['b']);
         }
          var chartdata = {
                labels: month,
                datasets: [
                    {
                        label: 'عدد الشكاوي في كل شهر في هذة السنة',
                        backgroundColor: 'RGB(243, 156 , 18)',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: ncomp
                    }
                ]
            };

            var graphTarget = $("#graphCanvas3");

            var barGraph = new Chart(graphTarget, {
                type: 'bar',
                data: chartdata
            });
           
       
       },
       'error':function(error){
           alert(error);
       }
   });
      }
     
     
     
 

     
     
 });
   