<?php
//http://localhost/TeamCoding/groupMain.php
require_once("groupInclude.php");
require_once("groupJavaScript.js");


//main
 WriteHeaders("Manlin Mao & Yanan PartA", "Group project","groupStyle.css");

 if (isset($_POST['f_Save']))
    saveFile($_POST['f_userInput']);
    else if (isset($_POST['f_Open'])) 
        $_POST['f_userInput']=openFile() ;
        
 drawMenu();
 
  
echo "<textarea name=\"f_userInput\" placeholder=\"enter text here\" form=\"userInput\">"
.$_POST['f_userInput']."</textarea>";



WriteFooters();

function drawMenu()
{
    
    echo"<div class=\"navbar\">";

        echo "<div class=\"dropdown\">";
            echo "<button class=\"dropbtn\">File
                 <i class=\"fa fa-caret-down\"></i>
                  </button>";

            echo"<div class=\"dropdown-content\">";
                drawFileDropDown();
            echo "</div>";
        echo "</div>";

        echo "<div class=\"dropdown\">";
            echo "<button class=\"dropbtn\">Edit 
                 <i class=\"fa fa-caret-down\"></i>
                  </button>";

            echo"<div class=\"dropdown-content\">";
                drawEditDropDown();
            echo "</div>";
        echo "</div>";


        //FONT functions below 

       echo "<div class=\"dropdown\">";
             echo "<button class=\"dropbtn\">Font 
                  <i class=\"fa fa-caret-down\"></i>
                   </button>";

             echo"<div class=\"dropdown-content\">";
                 drawFontDropDown();
             echo "</div>";
         echo "</div>";
        

    echo "</div>";
   
}

function drawFileDropDown()
{
    //call saveFile, openFile
    echo "<form action = ? method=post id=\"userInput\">";

    
    DisplayButton("f_New", "New","","New Button","fill");
    
    DisplayButton("f_Open", "Open","","Open Button","fill");
   
    DisplayButton("f_Save", "Save","","Save Button","fill");
    
    echo"</form>";
    
}


function drawEditDropDown()
{
   
    echo "<form action = ? method=post>";
    echo "<div class=\"DataPair\">";
    DisplayLabel("Find");
    echo "</div>";
    echo "<div class=\"DataPair\">";
    DisplayTextBox("text","f_searchName","10", "","");
    echo "</div>";
    echo "<div class=\"DataPair\">";
    DisplayLabel("Case Sensitive");
       
    DisplayTextBox("checkbox", "f_caseSensitive", "10", "Case Sensitive","" );
    echo "</div>";
    echo "<div class=\"DataPair\">";
    DisplayButton("f_Find", "Find","","Find Button","fill");
    "</div>";
    echo"</form>";
    
}


function saveFile($Text)
{
    //This function create/open a file
    //write from the end,"a" specify for it
    $textFile = fopen("editor.dat","w+");
    $successSave=false;
    if($textFile)
    {
        echo "<p>File opened.</p>";
       $successSave=fwrite($textFile,$Text);
    }
    else {
        echo "<p>Error opening file.</p>";
    }

    if($successSave)
    {
        echo "<p>File saved.</p>";
    }else{
        echo "<p>Error saving file.</p>";
    }
    fclose($textFile);
   
}

function openFile()
{
    //This function open a exist file for READ only
    //"r" specify read only
    $Text="";
    $textFile = fopen("editor.dat","r");
    if($textFile)
    {
        echo "<p>File opened.</p>";
        while(!feof($textFile)){
            $Text .= fgets($textFile);
         
        }
    }
    else{
        echo "<p>Error opening file.</p>";
        $exist=file_exists($textFile);
        if(!$exist)
        {
            echo "<p>Editor.dat does not exist. Please save file first</p>"; 
        }
    }
    fclose($textFile);
    return $Text;
    
}

function drawFontDropDown()
{
    // Functionality 1


    $mysqlObj = CreateConnectionObject();
    $TableName = "fontNames";
    $query = "select * from $TableName ";
    $stmtObj = $mysqlObj->prepare($query);
    $stmtObj -> execute(); 
    $BindResult = $stmtObj->bind_result($fontName);
    $counter = 0;

    //echo "<ul>";
    //while ($stmtObj->fetch())
    //{      
    //    echo "<li>$fontName</li>";
       //$counter++;
    //}

    
    DisplayLabel("Font");   
    echo "<form action = ? method=post>";
    echo " <select id = \"font\" Font = \"1\">";
    while ($stmtObj->fetch())
    {      
        echo "<option value = \"$fontName\"> $fontName </option>";
    }
    echo "</select>";

    
    
    echo"</form>";
    $mysqlObj->close();
    $stmtObj->close();

    //Functionality 3
    DisplayLabel("Font Size");
    echo "
    <form action= ? method=post>
        <select id = \"fontSize\" Size = \"1\">
            <option value = \"small\"> Small </option>
            <option value = \"medium\"> Medium </option>
            <option value = \"large\"> Large </option>
        </select>
    </form>";
    
}
//http://localhost/TeamCoding/groupMain.php


?>