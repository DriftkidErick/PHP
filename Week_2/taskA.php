<form name="patient" method="post" action="patient.php">
        
        <div class="wrapper">
            <div class="label">
                <label>First Name:</label>
            </div>
            <div>
                <input type="text" name="first_name" value="" wfd-id="id0">
            </div>
            <div class="label">
                <label>Last Name:</label>
            </div>
            <div>
                <input type="text" name="last_name" value="" "="" wfd-id="id1">
            </div>
            <div class="label">
                <label>Married:</label>
            </div>
            <div>
                <input type="radio" name="married" value="yes" wfd-id="id2">Yes

                    
                <input type="radio" name="married" value="no" wfd-id="id3">No
                
            </div>
            <div class="label">
                <label>Conditions:</label>
            </div>
            <div>
                                   <input type="checkbox" name="conditions[]" value="High Blood Pressure" wfd-id="id4">High Blood Pressure                                   <input type="checkbox" name="conditions[]" value="Diabetes" wfd-id="id5">Diabetes                                   <input type="checkbox" name="conditions[]" value="Heart Condition" wfd-id="id6">Heart Condition                           </div>
            <div class="label">
                <label>Birth Date:</label>
            </div>
            <div>
                <input type="date" name="birth_date" value="" wfd-id="id7">
                
                
            </div>
            <div class="label">
                <label>Height:</label>
            </div>
            <div>
            Feet: <input type="text" name="ft" value="" style="width:40px;" wfd-id="id8">
            Inches: <input type="text" name="inches" value="0" style="width:40px;" wfd-id="id9">
                
                
                
            </div>
            <div class="label">
                <label>Weight (pounds):</label>
            </div>
            <div>
                <input type="text" name="weight" value="" style="width:40px;" wfd-id="id10">
                
                
            </div>
            <div>
                &nbsp;
            </div>
            <div>
                <input type="submit" name="storePatient" value="Store Patient Information" wfd-id="id11">
            </div>
           
        </div>

       
    </form>