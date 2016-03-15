    <script type="text/javascript">   
    function check()
    {
          var reg = new RegExp("^[0-9]*$");
          if(!/^[0-9]*$/.test(document.getElementById("real_number").value))
          {
              alert("请在实到人数框内输入数字!");
              return false;
          }
          else
          {
            if(document.getElementById("real_number").value == "")
            {  
                alert("请填写实到人数!"); 
                return false;  
            }
            else
            { 
                if(confirm( '提交之后无法修改，请确定是否提交？ ')==false)
                  return   false;
                else
                  return true;
            }  
          }
            
    }
    </script>