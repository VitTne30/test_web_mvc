const tentaikhoan = localStorage.getItem('tentaikhoan')
console.log("tentaikhoan:", tentaikhoan);
var inputTentaikhoan = document.querySelector('input[name="tentaikhoan"]');

inputTentaikhoan.value = tentaikhoan;
inputTentaikhoan.readOnly = true;

const list = document.querySelector(".list");
const btnDangxuat = document.getElementById('dangxuat');
const btnCreate = document.getElementById('btnCreate');
let subMenu = document.getElementById('subMenu');
const tbody = document.querySelector("tbody");

start();

function start(){
	loadDanhmuc(renderDanhmuc);
	getLichsudau(renderLichsudau);
}

btnCreate.addEventListener('click', ()=>{
	var inputMatkhau = document.querySelector('input[name="matkhau"]').value;
	var inputMatkhaumoi = document.querySelector('input[name="matkhaumoi"]').value;
	var inputXacnhanMatkhau = document.querySelector('input[name="xacnhanmatkhau"]').value;
	
	var formData = {
		tentaikhoan: tentaikhoan,
		matkhau: inputMatkhau,
	}
	
	var newFormData = {
		tentaikhoan: tentaikhoan,
		matkhau: inputMatkhaumoi,
	}
	
	console.log(formData);
	
	if(inputMatkhaumoi === inputXacnhanMatkhau) {
	
	fetch('http://localhost/test_web_mvc/api/account/login.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json'
		},
		body: JSON.stringify(formData)
	})
	.then(res => res.json())
	.then(data =>{
		if(data.message){
			fetch('http://localhost/test_web_mvc/api/account/changePass.php', {
			method: 'PUT',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify(newFormData)
			})
			.then(res => res.json())
			.then(data =>{
				if(data.message === "doi mat khau thanh cong"){
					alert('Đổi mật khẩu thành công');
				}
				else{
					alert('Đổi mật khẩu thất bại');
				}
			});
		}
		else{
			alert('Mật khẩu cũ chưa chính xác!!!');
		}
	});
	} else {
        alert('Mật khẩu mới và xác nhận mật khẩu mới không khớp!!!');
    }
});

function loadDanhmuc(data){
	fetch('http://localhost/test_web_mvc/api/danhmuc/read.php')
	.then(res => res.json())
	.then(data);
}

function renderDanhmuc(data){
	console.log(data);
	
	let htmlString = "";
	
	data.map(function(item){
		htmlString += `
				<li>
					<button class="statistics-button"><a href="DM.html?id=${item.id}">${item.tendanhmuc}</a></button>
					<input id="id_danhmuc" type="hidden" value="${item.id}">
				</li>
		`;
	});
	
	list.innerHTML = htmlString;
}

function getLichsudau(data) {
	fetch('http://localhost/test_web_mvc/api/lichsudau/show.php', {
			method: 'PUT',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({tentaikhoan: tentaikhoan})
			})
		.then(res => res.json())
		.then(data)
}

function renderLichsudau(data) {
	console.log(data);

	let htmlString = "";

	data.map(function (item, index) {
		htmlString += `
			<tr>
				<td>${index + 1}</td>
				<td>${item.diemso}/5</td>
				<td>${item.thoigian}</td>
			</tr>
		`;
	});

	tbody.innerHTML = htmlString;
}

btnDangxuat.addEventListener('click', ()=>{
	if (confirm("Xác nhận đăng xuất?") !== true) {
		return; // Exit the function if user cancels
	}
	localStorage.removeItem('tentaikhoan');
	window.location.href = "login.html";
})

function toggleMenu(){
	subMenu.classList.toggle("open-menu");
}