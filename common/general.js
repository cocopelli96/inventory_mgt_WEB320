/*
	The following code setup was borrowed from Stack Overflow
	link: http://stackoverflow.com/questions/28452235/make-a-nav-bar-stick-to-the-top-when-scrolling-with-css 
	
	This code is used to fix the navbar to the top of the webpage after scrolling
*/

$(document).ready(function() {
	$(window).scroll(function () {
      	var scroll = $(window).scrollTop();
		if (scroll >= 70) {
			$('#nav').addClass('navbar-fixed-top');
			$('body').addClass('pad-for-nav');
		} else {
			$('#nav').removeClass('navbar-fixed-top');
			$('body').removeClass('pad-for-nav');
		}
	});
});

/* End borrowed code */

/* Add Validation Alert to form function */

function addAlert(text) {
	//remove any old alerts
	$('.table-mgt tbody')[0].removeChild($('.table-mgt tbody')[0].lastChild);

	//create new elements
	var tr = document.createElement('TR');
	var td = document.createElement('TD');
	var div = document.createElement('DIV');
	
	//set attributes of te element
	tr.classList.add('row-alert-invalid-input');
	
	//set attributes of td element
	td.setAttribute('colspan', '2');
	
	//set attributes of div element
	div.classList.add('alert')
	div.classList.add('alert-danger');
	div.setAttribute('role', 'alert');
	
	//create text node
	var text = document.createTextNode(text);
	
	//append all elements into tr element
	div.appendChild(text);
	td.appendChild(div);
	tr.appendChild(td);
	
	//add to page
	$('.table-mgt tbody')[0].appendChild(tr);
}

/* Form validation Javascript */

function editProductVal() {
	var name = $('#prod_name')[0];
	var descript = $('#prod_descript')[0];
	var quantity = $('#prod_quant')[0];
	var restock = $('#prod_stock')[0];
	var price = $('#price')[0];
	
	var RegExpText = /^[A-z a-z]+$/;
	var RegExpNumber = /^[0-9]+$/;
	var RegExpAll = /^\w+$/;
	
	if (name.value == '') {
		name.focus();
		name.select();
		name.style.backgroundColor = '#ffffcc';
		addAlert('Product name number is required.');
		
		return false;
	}
	if (!RegExpNumber.test(price.value)) {
		price.focus();
		price.select();
		price.style.backgroundColor = '#ffffcc';
		addAlert('Product price number is required, ensure it is a valid number.');
		
		return false;
	}
	if (!RegExpNumber.test(quantity.value)) {
		quantity.focus();
		quantity.select();
		quantity.style.backgroundColor = '#ffffcc';
		addAlert('Product quantity number is required, ensure it is a valid number.');
		
		return false;
	}
	if (!RegExpNumber.test(restock.value)) {
		restock.focus();
		restock.select();
		restock.style.backgroundColor = '#ffffcc';
		addAlert('Product restock number is required, ensure it is a valid number.');
		
		return false;
	}
	if (descript.value == '') {
		descript.focus();
		descript.select();
		descript.style.backgroundColor = '#ffffcc';
		addAlert('Product description is required.');
		
		return false;
	}
	
	return true;
}

function editPartVal() {
	var name = $('#part_name')[0];
	var vendor = $('#vid')[0];
	var quantity = $('#part_quant')[0];
	var restock = $('#part_stock')[0];
	
	var RegExpText = /^[A-z a-z]+$/;
	var RegExpNumber = /^[0-9]+$/;
	var RegExpAll = /^\w+$/;
	
	if (name.value == '') {
		name.focus();
		name.select();
		name.style.backgroundColor = '#ffffcc';
		addAlert('Part name number is required.');
		
		return false;
	}
	if (!RegExpNumber.test(vendor.value)) {
		vendor.focus();
		vendor.select();
		vendor.style.backgroundColor = '#ffffcc';
		addAlert('Part Vendor is required.');
		
		return false;
	}
	if (!RegExpNumber.test(quantity.value)) {
		quantity.focus();
		quantity.select();
		quantity.style.backgroundColor = '#ffffcc';
		addAlert('Product quantity number is required, ensure it is a valid number.');
		
		return false;
	}
	if (!RegExpNumber.test(restock.value)) {
		restock.focus();
		restock.select();
		restock.style.backgroundColor = '#ffffcc';
		addAlert('Product restock number is required, ensure it is a valid number.');
		
		return false;
	}
	
	return true;
}

function editRepVal() {
	var fn = $('#rep_fn')[0];
	var ln = $('#rep_ln')[0];
	var phone = $('#rep_cid_11')[0];
	var email = $('#rep_cid_22')[0];
	
	var RegExpText = /^[A-z a-z]+$/;
	var RegExpNumber = /^[0-9]+$/;
	var RegExpPhone = /^[0-9]{3}[\-]{1}[0-9]{3}[\-]{1}[0-9]{4}$/;
	var RegExpEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.[A-Za-z]{2,99})+$/;
	var RegExpAll = /^\w+$/;
	
	if (!RegExpText.test(fn.value)) {
		fn.focus();
		fn.select();
		fn.style.backgroundColor = '#ffffcc';
		addAlert('Vendor representative first name is required.');
		
		return false;
	}
	if (!RegExpText.test(ln.value)) {
		ln.focus();
		ln.select();
		ln.style.backgroundColor = '#ffffcc';
		addAlert('Vendor representative last name is required.');
		
		return false;
	}
	if ((phone != null && !RegExpPhone.test(phone.value)) || (email != null && !RegExpEmail.test(phone.value)))
	{
		if (!RegExpPhone.test(phone.value)) {
			phone.focus();
			phone.select();
			phone.style.backgroundColor = '#ffffcc';
			addAlert('Vendor representative phone number is required. Please use the format of  ###-###-####');
		
			return false;
		}
		if (!RegExpEmail.test(email.value)) {
			email.focus();
			email.select();
			email.style.backgroundColor = '#ffffcc';
			addAlert('Vendor representative email is required');
		
			return false;
		}
	}
	
	return true;
}

function editOrderVal() {
	var stat_id = $('#stat_id')[0];
	
	var RegExpText = /^[A-z a-z]+$/;
	var RegExpNumber = /^[0-9]+$/;
	var RegExpPhone = /^[0-9]{3}[\-]{1}[0-9]{3}[\-]{1}[0-9]{4}$/;
	var RegExpEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.[A-Za-z]{2,99})+$/;
	var RegExpAll = /^\w+$/;
	
	if (!RegExpNumber.test(stat_id.value)) {
		stat_id.focus();
		stat_id.select();
		stat_id.style.backgroundColor = '#ffffcc';
		addAlert('Status Code is required.');
		
		return false;
	}
	
	return true;
}

function editEmployeeVal() {
	var fn = $('#ufn')[0];
	var ln = $('#uln')[0];
	var position = $('#pos_id')[0];
	var salary = $('#salary')[0];
	var prom_id = $('#prom_id')[0];
	
	var RegExpText = /^[A-z a-z]+$/;
	var RegExpNumber = /^[0-9]+$/;
	var RegExpPhone = /^[0-9]{3}[\-]{1}[0-9]{3}[\-]{1}[0-9]{4}$/;
	var RegExpEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.[A-Za-z]{2,99})+$/;
	var RegExpAll = /^\w+$/;
	
	if (!RegExpText.test(fn.value)) {
		fn.focus();
		fn.select();
		fn.style.backgroundColor = '#ffffcc';
		addAlert('Employee first name is required.');
		
		return false;
	}
	if (!RegExpText.test(ln.value)) {
		ln.focus();
		ln.select();
		ln.style.backgroundColor = '#ffffcc';
		addAlert('Employee last name is required.');
		
		return false;
	}
	if (!RegExpNumber.test(pos_id.value)) {
		pos_id.focus();
		pos_id.select();
		pos_id.style.backgroundColor = '#ffffcc';
		addAlert('Position is required.');
		
		return false;
	}
	if (!RegExpNumber.test(salary.value)) {
		salary.focus();
		salary.select();
		salary.style.backgroundColor = '#ffffcc';
		addAlert('Salary is required, ensure it is a valid number.');
		
		return false;
	}
	if (!RegExpNumber.test(prom_id.value)) {
		prom_id.focus();
		prom_id.select();
		prom_id.style.backgroundColor = '#ffffcc';
		addAlert('Promotion Type is required.');
		
		return false;
	}
	
	return true;
}

function addEmployeeVal() {
	var fn = $('#ufn')[0];
	var ln = $('#uln')[0];
	var position = $('#pos_id')[0];
	var salary = $('#salary')[0];
	
	var RegExpText = /^[A-z a-z]+$/;
	var RegExpNumber = /^[0-9]+$/;
	var RegExpPhone = /^[0-9]{3}[\-]{1}[0-9]{3}[\-]{1}[0-9]{4}$/;
	var RegExpEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.[A-Za-z]{2,99})+$/;
	var RegExpAll = /^\w+$/;
	
	if (!RegExpText.test(fn.value)) {
		fn.focus();
		fn.select();
		fn.style.backgroundColor = '#ffffcc';
		addAlert('Employee first name is required.');
		
		return false;
	}
	if (!RegExpText.test(ln.value)) {
		ln.focus();
		ln.select();
		ln.style.backgroundColor = '#ffffcc';
		addAlert('Employee last name is required.');
		
		return false;
	}
	if (!RegExpNumber.test(pos_id.value)) {
		pos_id.focus();
		pos_id.select();
		pos_id.style.backgroundColor = '#ffffcc';
		addAlert('Position is required.');
		
		return false;
	}
	if (!RegExpNumber.test(salary.value)) {
		salary.focus();
		salary.select();
		salary.style.backgroundColor = '#ffffcc';
		addAlert('Salary is required, ensure it is a valid number.');
		
		return false;
	}
	
	return true;
}

function editAccountVal() {
	var fn = $('#ufn')[0];
	var ln = $('#uln')[0];
	var screen_name = $('#uname')[0];
	var password = $('#upass')[0];
	
	var RegExpText = /^[A-z a-z]+$/;
	var RegExpNumber = /^[0-9]+$/;
	var RegExpPhone = /^[0-9]{3}[\-]{1}[0-9]{3}[\-]{1}[0-9]{4}$/;
	var RegExpEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.[A-Za-z]{2,99})+$/;
	var RegExpAll = /^\w+$/;
	var RegExpNum3 = /^[0-9]{3}$/;
	var RegExpNum4 = /^[0-9]{4}$/;
	var RegExpState = /^[A-Z]{2}$/;
	var RegExpZip = /^[0-9]{5}$/;
	
	if (!RegExpText.test(fn.value)) {
		fn.focus();
		fn.select();
		fn.style.backgroundColor = '#ffffcc';
		addAlert('User first name is required.');
		
		return false;
	}
	if (!RegExpText.test(ln.value)) {
		ln.focus();
		ln.select();
		ln.style.backgroundColor = '#ffffcc';
		addAlert('User last name is required.');
		
		return false;
	}
	if (uname.value == '') {
		uname.focus();
		uname.select();
		uname.style.backgroundColor = '#ffffcc';
		addAlert('User screen name is required.');
		
		return false;
	}
	if (upass.value == '') {
		upass.focus();
		upass.select();
		upass.style.backgroundColor = '#ffffcc';
		addAlert('User password is required.');
		
		return false;
	}
	
	var add_array = ['11','22','33'];
	var phone_array = ['1','2','3'];
	var email_array = ['4','5'];
	
	for (i = 0; i < add_array.length(); i++)
	{
		var street = $('#' + add_array[i] + '_street')[0];
		var city = $('#' + add_array[i] + '_city')[0];
		var state = $('#' + add_array[i] + '_state')[0];
		var zip = $('#' + add_array[i] + '_zip')[0];
		
		if (street.value == '') {
			street.focus();
			street.select();
			street.style.backgroundColor = '#ffffcc';
			addAlert('Street is required.');
		
			return false;
		}
		if (!RegExpText.test(city.value)) {
			city.focus();
			city.select();
			city.style.backgroundColor = '#ffffcc';
			addAlert('City is required.');
		
			return false;
		}
		if (!RegExpState.test(state.value)) {
			state.focus();
			state.select();
			state.style.backgroundColor = '#ffffcc';
			addAlert('State is required.');
		
			return false;
		}
		if (!RegExpZip.test(zip.value)) {
			zip.focus();
			zip.select();
			zip.style.backgroundColor = '#ffffcc';
			addAlert('Zip is required.');
		
			return false;
		}
	}
	
	for (j = 0; j < phone_array.length(); j++)
	{
		var area = $('#' + phone_array[i] + '_area')[0];
		var mid = $('#' + phone_array[i] + '_mid')[0];
		var end = $('#' + phone_array[i] + '_end')[0];
		
		if (!RegExpNum3.test(area.value)) {
			area.focus();
			area.select();
			area.style.backgroundColor = '#ffffcc';
			addAlert('Area code of the phone number is required.');
		
			return false;
		}
		if (!RegExpNum3.test(mid.value)) {
			mid.focus();
			mid.select();
			mid.style.backgroundColor = '#ffffcc';
			addAlert('Middle of the phone number is required.');
		
			return false;
		}
		if (!RegExpNum4.test(end.value)) {
			end.focus();
			end.select();
			end.style.backgroundColor = '#ffffcc';
			addAlert('Ending of the phone number is required.');
		
			return false;
		}
	}
	
	for (k = 0; k < email_array.length(); k++)
	{
		var email = $('#' + email_array[i] + '_email')[0];
		
		if (!RegExpEmail.test(email.value)) {
			email.focus();
			email.select();
			email.style.backgroundColor = '#ffffcc';
			addAlert('Email is required.');
		
			return false;
		}
	}
	
	return true;
}

function addVendorVal() {
	var vname = $('#vname')[0];
	
	var RegExpText = /^[A-z a-z]+$/;
	var RegExpNumber = /^[0-9]+$/;
	var RegExpPhone = /^[0-9]{3}[\-]{1}[0-9]{3}[\-]{1}[0-9]{4}$/;
	var RegExpEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.[A-Za-z]{2,99})+$/;
	var RegExpAll = /^\w+$/;
	var RegExpNum3 = /^[0-9]{3}$/;
	var RegExpNum4 = /^[0-9]{4}$/;
	var RegExpState = /^[A-Z]{2}$/;
	var RegExpZip = /^[0-9]{5}$/;
	
	if (vname.value == '') {
		vname.focus();
		vname.select();
		vname.style.backgroundColor = '#ffffcc';
		addAlert('Vendor name is required.');
		
		return false;
	}
	
	return true;
}

function addProductPartVal() {
	var part_id = $('#part_id')[0];
	
	var RegExpText = /^[A-z a-z]+$/;
	var RegExpNumber = /^[0-9]+$/;
	var RegExpPhone = /^[0-9]{3}[\-]{1}[0-9]{3}[\-]{1}[0-9]{4}$/;
	var RegExpEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.[A-Za-z]{2,99})+$/;
	var RegExpAll = /^\w+$/;
	var RegExpNum3 = /^[0-9]{3}$/;
	var RegExpNum4 = /^[0-9]{4}$/;
	var RegExpState = /^[A-Z]{2}$/;
	var RegExpZip = /^[0-9]{5}$/;
	
	if (!RegExpNumber.test(part_id.value)) {
		part_id.focus();
		part_id.select();
		part_id.style.backgroundColor = '#ffffcc';
		addAlert('Part is required.');
		
		return false;
	}
	
	return true;
}

function addContactVal() {
	var cont_id = $('#cont_id')[0];
	
	var RegExpText = /^[A-z a-z]+$/;
	var RegExpNumber = /^[0-9]+$/;
	var RegExpPhone = /^[0-9]{3}[\-]{1}[0-9]{3}[\-]{1}[0-9]{4}$/;
	var RegExpEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.[A-Za-z]{2,99})+$/;
	var RegExpAll = /^\w+$/;
	var RegExpNum3 = /^[0-9]{3}$/;
	var RegExpNum4 = /^[0-9]{4}$/;
	var RegExpState = /^[A-Z]{2}$/;
	var RegExpZip = /^[0-9]{5}$/;
	
	if (!RegExpNumber.test(cont_id.value)) {
		cont_id.focus();
		cont_id.select();
		cont_id.style.backgroundColor = '#ffffcc';
		addAlert('You must select a contact type.');
	
		return false;
	}
		
	if (cont_id.value == 1 || cont_id.value == 2 || cont_id.value == 3)
	{
		var area = $('#area_code')[0];
		var mid = $('#mid_num')[0];
		var end = $('#end_num')[0];
		
		if (!RegExpNum3.test(area.value)) {
			area.focus();
			area.select();
			area.style.backgroundColor = '#ffffcc';
			addAlert('Area code of the phone number is required.');
		
			return false;
		}
		if (!RegExpNum3.test(mid.value)) {
			mid.focus();
			mid.select();
			mid.style.backgroundColor = '#ffffcc';
			addAlert('Middle of the phone number is required.');
		
			return false;
		}
		if (!RegExpNum4.test(end.value)) {
			end.focus();
			end.select();
			end.style.backgroundColor = '#ffffcc';
			addAlert('Ending of the phone number is required.');
		
			return false;
		}
	}
	else if (cont_id.value == 4 || cont_id.value == 5)
	{
		var email = $('#email')[0];
		
		if (!RegExpEmail.test(email.value)) {
			email.focus();
			email.select();
			email.style.backgroundColor = '#ffffcc';
			addAlert('Email is required.');
		
			return false;
		}
	}
	else
	{
		cont_id.focus();
		cont_id.select();
		cont_id.style.backgroundColor = '#ffffcc';
		addAlert('You must select a contact type.');
	
		return false;
	}
	
	return true;
}

function addAddressVal() {
	var add_type = $('#add_type_id')[0];
	var street = $('#street')[0];
	var city = $('#city')[0];
	var state = $('#state')[0];
	var zip = $('#zip')[0];
	
	
	var RegExpText = /^[A-z a-z]+$/;
	var RegExpNumber = /^[0-9]+$/;
	var RegExpPhone = /^[0-9]{3}[\-]{1}[0-9]{3}[\-]{1}[0-9]{4}$/;
	var RegExpEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.[A-Za-z]{2,99})+$/;
	var RegExpAll = /^\w+$/;
	var RegExpNum3 = /^[0-9]{3}$/;
	var RegExpNum4 = /^[0-9]{4}$/;
	var RegExpState = /^[A-Z]{2}$/;
	var RegExpZip = /^[0-9]{5}$/;
	
	if (!RegExpNumber.test(add_type.value)) {
		add_type.focus();
		add_type.select();
		add_type.style.backgroundColor = '#ffffcc';
		addAlert('You must select an address type.');
	
		return false;
	}
	if (street.value == '') {
		street.focus();
		street.select();
		street.style.backgroundColor = '#ffffcc';
		addAlert('Street is required.');
	
		return false;
	}
	if (!RegExpText.test(city.value)) {
		city.focus();
		city.select();
		city.style.backgroundColor = '#ffffcc';
		addAlert('City is required.');
	
		return false;
	}
	if (!RegExpState.test(state.value)) {
		state.focus();
		state.select();
		state.style.backgroundColor = '#ffffcc';
		addAlert('State is required.');
	
		return false;
	}
	if (!RegExpZip.test(zip.value)) {
		zip.focus();
		zip.select();
		zip.style.backgroundColor = '#ffffcc';
		addAlert('Zip is required.');
	
		return false;
	}
	
	return true;
}

/* End Form validation */

/* Start event handlers */

function changeContId() {
	var cont_id = $('#cont_id')[0];
	var row1 = $('#row1_hold')[0];
	var row2 = $('#row2_hold')[0];
	var row3 = $('#row3_hold')[0];
	
	if (cont_id.value == 1 || cont_id.value == 2 || cont_id.value == 3) {
		row1.innerHTML = '<td><label for="area_code">Area Code:</label></td><td><input type="text" name="area_code" id="area_code" value="" class="form-control" /></td>';
		row2.innerHTML = '<td><label for="mid_num">Middle Numbers:</label></td><td><input type="text" name="mid_num" id="mid_num" value="" class="form-control" /></td>';
		row3.innerHTML = '<td><label for="end_num">End Numbers:</label></td><td><input type="text" name="end_num" id="end_num" value="" class="form-control" /></td>';
	} else if (cont_id.value == 4 || cont_id.value == 5) {
		row1.innerHTML = '<td><label for="email">Email:</label></td><td><input type="text" name="email" id="email" value="" class="form-control" /></td>';
		row2.innerHTML = '';
		row3.innerHTML = '';
	} else {
		row1.innerHTML = '';
		row2.innerHTML = '';
		row3.innerHTML = '';
	}
}

/* End event handlers */