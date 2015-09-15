function ajaxFunction(theData){

   var ajaxRequest;

   try{
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   } catch (e){
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         } catch (e){
            alert("Your browser broke!");
            return false;
         }
      }
   }

   ajaxRequest.onreadystatechange = function(){
      if(ajaxRequest.readyState == 4){
         var ajaxDisplay = document.getElementById('resultDiv');
         ajaxDisplay.style.display = 'block';
         ajaxDisplay.innerHTML = ajaxRequest.responseText;
         document.getElementById(theData).disabled = "disabled";
         document.getElementById(theData+"-button").disabled = "disabled";
      }
   }
   var data = document.getElementById(theData).value;
   if(data == "") {
      alert("You must fill in your name.");
      return;
   }
   var queryString = "?slot=" + data + "&date=" + theData;
   ajaxRequest.open("GET", "process_slot.php" + queryString, true);
   ajaxRequest.send(null);
}
