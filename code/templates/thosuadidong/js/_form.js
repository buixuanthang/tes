/*************** CHECK FORM ***************/
//If the length of the element's string is 0 then display helper message
function notEmpty(elemid, helperMsg){
	elem  = $('#'+elemid);
	if(elem.val().length == 0){
		$('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#'+elemid);
		invalid(elemid);
		elem.focus(); // set the focus to this input
		return false;
	}
	else
	{
		valid(elemid);
		return true;
	}
}
//For texarea
function notEmptyTextarea(elemid, helperMsg){
	elem  = $('#'+elemid);
	if(elem.val().length==0){
		$('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#'+elemid);
		invalid(elemid);
		elem.focus(); // set the focus to this input
		return false;
	}
	else
	{
		valid(elemid);
		return true;
	}
}
function isPhone(elemid, helperMsg){
	elem  = $('#'+elemid);
	var numericExpression = /^[0-9 .]+$/;
	if(elem.val().match(numericExpression)){
		valid(elemid);
		return true;
	}else{
		$('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#'+elemid);
		invalid(elemid);
		return false;
	}
}
function isUsername(elemid, helperMsg){
	elem  = $('#'+elemid);
	var strExp = /^[0-9a-zA-Z_-]+$/;
	if(elem.val().match(strExp)){
		valid(elemid);
		return true;
	}else{
		$('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#'+elemid);
		invalid(elemid);
		return false;
	}
}

//If the element's string matches the regular expression it is all numbers

function isNumeric(elemid, helperMsg){
	elem  = $('#'+elemid);
	var numericExpression = /^[0-9]+$/;
	if(elem.val().match(numericExpression)){
		valid(elemid);
		return true;
	}else{
		$('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#'+elemid);
//		document.getElementById('msg_error').innerHTML += "<li>"+helperMsg+"</li>";
//		alert(helperMsg);
		invalid(elemid);
		elem.focus();
		return false;
	}
}

/*
 * check number list follow: 048082354;09238549; 
 */
function isNumericList(elemid, helperMsg){
	elem  = $('#'+elemid);
	var numericExpression = /^[0-9; ]+$/;
	if(elem.val().match(numericExpression)){
		valid(elemid);
		return true;
	}else{
		$('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#'+elemid);
//		document.getElementById('msg_error').innerHTML = "<li>"+ helperMsg+"</li>";
//		alert(helperMsg);
		invalid(elemid);
		elem.focus();
		return false;
	}
}

//If the element's string matches the regular expression it is all letters
function isAlphabet(elemid, helperMsg){
	elem  = $('#'+elemid);
	var alphaExp = /^[a-zA-Z]+$/;
	if(elem.val().match(alphaExp)){
		return true;
	}else{
		$('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#'+elemid);
//		document.getElementById('msg_error').innerHTML = helperMsg;
		
//		alert(helperMsg);
		elem.focus();
		return false;
	}
}

//If the element's string matches the regular expression it is numbers and letters
function isAlphanumeric(elemid, helperMsg){
	
	elem  = $('#'+elemid);
	var alphaExp = /^[0-9a-zA-Z]+$/;
	if(elem.val().match(alphaExp)){
		return true;
	}else{
		$('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#'+elemid);
//		document.getElementById('msg_error').innerHTML = helperMsg;
		elem.focus();
		return false;
	}
}


// Limit length
function lengthRestriction(elemid, min, max){
	elem  = $('#'+elemid);
	var uInput = elem.val();
	if(uInput.length >= min && uInput.length <= max){
		valid(elemid);
		return true;
	}else{
		$('<br/><label class=\'label_error\'>'+'Bạn hãy nhập từ ' +min+ ' đến ' +max+ ' ký tự'+'</label>').insertAfter('#'+elemid);
//		document.getElementById('msg_error').innerHTML = "Please enter between " +min+ " and " +max+ " characters";
//		alert("Please enter between " +min+ " and " +max+ " characters");
		invalid(elemid);
		elem.focus();
		return false;
	}
}

// Min length
function lengthMin(elemid, min, helperMsg){
	elem  = $('#'+elemid);
	var uInput = elem.val();
	if(uInput.length >= min ){
		valid(elemid);
		return true;
	}else{
		$('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#'+elemid);
//		document.getElementById('msg_error').innerHTML  += "<li>"+helperMsg+"</li>";
//		elem.focus();
		invalid(elemid);
		return false;
	}
}


// Select box ( multi select)
function madeSelection(elemid, helperMsg){
	elem  = $('#'+elemid);
	  var i;
	  for (i=0; i<elem.options.length; i++) {
	    if (elem.options[i].selected && ( elem.options[i].value != "") ){
	      return true;
	    }
	  }
	  $('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#'+elemid);
//	  document.getElementById('msg_error').innerHTML = helperMsg;
	  return false;
}

// Select checkbox
function madeCheckbox(elemid, helperMsg)
{
	elem  = $('#'+elemid);
	if(elem.is(':checked') == false){
//		$('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#'+elemid);
		alert(helperMsg);
		return false;
		invalid(elemid);
	}
	else
	{
//		valid(elemid);
		return true;
	}
}

/*
 *  For checkbox multi.
 *  Min 1 item is checked
 */
function checkMultiCheckbox(containerid,helperMsg) {
	fields = $('#'+containerid).find('input:checked');
	length_checked = fields.length;
	if (!length_checked) {
		$('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#'+elemid);
//    	document.getElementById('msg_error').innerHTML += "<li>"+helperMsg+"</li>";
        return false; // The form will *not* submit
    }
    return true;
}


// Email
function emailValidator(elemid, helperMsg){
	elem  = $('#'+elemid);
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(elem.val().match(emailExp)){
		valid(elemid);
		return true;
	}else{
		$('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#'+elemid);
//		document.getElementById('msg_error').innerHTML += "<li>"+helperMsg+"</li>";
		invalid(elemid);
		return false;
	}
}

// Password and repassword
function checkMatchPass(helperMsg){
	elem_value  = $('#password').val();
	elem2_value  = $('#re-password').val();
	
	if(elem_value != elem2_value )
	{
		$('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#re-password');
		invalid('re-password');
		return false;
	}
	else
	{
		valid('re-password');
		return true;
	}
}
function checkMatchPass_2(pass,repass,helperMsg){
	elem_value  = $('#'+pass).val();
	elem2_value  = $('#'+repass).val();
	if(elem_value != elem2_value )
	{
		$('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#'+elemid);
		invalid(repass);
		return false;
	}
	else
	{
		valid(repass);
		return true;
	}
}

// Email and re-email

function checkMatchEmail(helperMsg){
	elem_value  = $('#email').val();
	elem2_value  = $('#re-email').val();
	
	if(elem_value != elem2_value )
	{
		$('<br/><label class=\'label_error\'>'+helperMsg+'</label>').insertAfter('#re-email');
		invalid('re-email');
		return false;
	}
	else
	{	
		valid('re-email');
		return true;
	}
}

/*
 * Change border color where valid
 */
function valid(element)
{
	$("#"+element).removeClass("redborder");
	
}
/*
 * Change border color where invalid
 */
function invalid(element){
	$("#"+element).addClass("redborder");
	$("#"+element).focus();
}

/************* NEW FUNTION : CHECK ALL, SUBMIT FORM ***********/
function checkAll( n, fldName ,c ) {
	
	  if (!fldName) {
	     fldName = 'cb';
	  }
		var f = document.fontForm;
		
		var n2 = 0;
		for (i=0; i < n; i++) {
			cb = eval( 'f.' + fldName + '' + i );
			if (cb) {
				
				cb.checked = c;
				n2++;
			}
		}
		if (c) {
			document.fontForm.boxchecked.value = n2;
		} else {
			document.fontForm.boxchecked.value = 0;
		}
	}
	function isChecked(isitchecked){
		if (isitchecked == true){
			document.fontForm.boxchecked.value++;
		}
		else {
			document.fontForm.boxchecked.value--;
		}
	}
	function checkSubmit(msg)
	{
		if(document.fontForm.boxchecked.value == 0)
		{
			alert(msg);
			return false;
		}
		else
		{
			return true;
		}
			
	}
	function submitform(pressbutton){
		if (pressbutton) {
			document.fontForm.task.value=pressbutton;
		}
		if (typeof document.fontForm.onsubmit == "function") {
			document.fontForm.onsubmit();
		}
		document.fontForm.submit();
	}
	function submitform(pressbutton,msg){
		if(msg)
		{
			if(confirm(msg))
			{
				if (pressbutton) {
					document.fontForm.task.value=pressbutton;
				}
				if (typeof document.fontForm.onsubmit == "function") {
					document.fontForm.onsubmit();
				}
				document.fontForm.submit();
			}
		}
	}

