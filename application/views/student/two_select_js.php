<script type="text/javascript">
    var list1 = new Array;
    var list2 = new Array;

    <?php
        foreach ($teaching_building_array as $key => $value)
        {
            echo 'list1[list1.length] ="'.$value['teaching_building_number'].'";'."\n";
        }

        foreach ($classroom_array as $key => $classroom_array_value)
        {
            echo 'list2[list2.length] = new Array(';
            $result = NULL;
           foreach ($classroom_array_value as $key => $value) 
           {
               $result.='"'.$value['classroom_number'].'",';
           }
           echo substr($result, 0, -1);
            echo ');'."\n";
            
        }
    ?>
    
    var ddlschool = document.getElementById("teaching_building");
    var ddlmajor = document.getElementById("classroom");
    for(var i =0;i<list1.length; i++)
    {
        var option = document.createElement("option");
        option.appendChild(document.createTextNode(list1[i]));
        option.value = list1[i];
        ddlschool.appendChild(option);
        //major initialize
        var firstschool = list2[0];
        for (var j = 0; j < firstschool.length; j++) {
            var optionmajor = document.createElement("option");
            optionmajor.appendChild(document.createTextNode(firstschool[j]));
            optionmajor.value = firstschool[j];
            ddlmajor.appendChild(optionmajor);
        }
    }
    function indexof(obj,value)
    {
        var k=0;
        for(;k<obj.length;k++)
        {
            if(obj[k] == value)
            return k;
        }
        return k;
    }
    function selectschool(obj) {
        ddlmajor.options.length = 0;//clear
        var index = indexof(list1,obj.value);
        var list2element = list2[index];
        for(var i =0;i<list2element.length; i++)
        {
            var option = document.createElement("option");
            option.appendChild(document.createTextNode(list2element[i]));
            option.value = list2element[i];
            ddlmajor.appendChild(option);
        }
    }
</script>
