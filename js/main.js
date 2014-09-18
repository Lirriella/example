function useAjax(url,val)
{
 $.ajax({
   type: "GET",
   contentType: 'application/x-www-form-urlencoded; charset=windows-1251;', 
   scriptCharset: "CP1251",
   url: url,
   data: {val:val},
   success: function(data){
     $('.books').html(data);
   }
   });
 }