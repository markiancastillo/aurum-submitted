$('#thedate').datepicker();

$('#checkDate').bind('click', function() {
  var selectedDate = $('#thedate').datepicker('getDate');
  var today = new Date(); 
  var targetDate= new Date();
  targetDate.setDate(today.getDate()+ 30);
  targetDate.setHours(0);
  targetDate.setMinutes(0);
  targetDate.setSeconds(0);

  if (Date.parse(targetDate ) >Date.parse(selectedDate)) {
    alert('Within Date limits');
  } else {
    alert('not Within Date limits');
  }
});