const addForm = document.getElementById("add-user-form");
const editForm = document.getElementById("edit-user-form");
const tbody = document.querySelector("tbody");
const btnDangxuat = document.getElementById('dangxuat');

start();

function start() {
	getAccount(renderAccount);
	createAccount();
}

addForm.addEventListener("submit", async (e) => {
	e.preventDefault();

	const formData = new FormData(addForm);
	formData.append("add", 1);

	if (addForm.checkValidity() === false) {
		e.preventDefault();
		e.stopPropagation();
		addForm.classList.add("was-validated");
		return false;
	}
});

editForm.addEventListener("submit", async (e) => {
	e.preventDefault();

	const formData = new FormData(editForm);
	formData.append("add", 1);

	if (editForm.checkValidity() === false) {
		e.preventDefault();
		e.stopPropagation();
		editForm.classList.add("was-validated");
		return false;
	}
});

function getAccount(data) {
	fetch('http://localhost/test_web_mvc/api/account/read.php')
		.then(res => res.json())
		.then(data)
}

function renderAccount(data) {
	console.log(data);

	let htmlString = "";

	data.map(function (item, index) {
		htmlString += `
			<tr>
				<td>${index + 1}</td>
				<td>${item.tentaikhoan}</td>
				<td>${item.matkhau}</td>
				<td>${item.email}</td>
				<td>
					<button class="btn btn-success btn-sm rounded-pill py-0 editLink" data-toggle="modal" data-target="#editUserModal" onclick="updateAccount(${item.id})">Sửa</button>
					<button class="btn btn-danger btn-sm rounded-pill py-0 deleteLink" onclick="deleteAccount(${item.id})">Xoá</button>
				</td>
			</tr>
		`;
	});

	tbody.innerHTML = htmlString;
}

function updateAccount(idAcc) {
	console.log(idAcc);
	
	fetch(`http://localhost/test_web_mvc/api/account/show.php?id=${idAcc}`)
    .then(res => res.json())
    .then(data => {
//		console.log(data.tentaikhoan);
//		console.log(data.matkhau);
//		console.log(data.email);
		var tentk = data.tentaikhoan;
		var mk = data.matkhau;
		var e = data.email;
      	document.querySelector('input[name="Updatetentaikhoan"]').value = tentk;
		document.querySelector('input[name="Updatematkhau"]').value = mk;
		document.querySelector('input[name="Updateemail"]').value = e;
    })
    .catch(error => console.error(error));

	var btnEdit = document.querySelector('#btnEdit');

	btnEdit.addEventListener('click', () => {

		var Updatetentaikhoan = document.querySelector('input[name="Updatetentaikhoan"]').value;
		var Updatematkhau = document.querySelector('input[name="Updatematkhau"]').value;
		var Updateemail = document.querySelector('input[name="Updateemail"]').value;

		let errorMessage = ""; // Initialize error message

		if (Updatetentaikhoan === "" || Updatematkhau === "" || Updateemail === "") {
			errorMessage = "Vui lòng nhập đầy đủ thông tin tài khoản (tên tài khoản, mật khẩu, email).\n";
		} else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(Updateemail)) {
			errorMessage = "Email không hợp lệ. Vui lòng nhập đúng định dạng (e.g., example@domain.com).\n";
		}

		if (errorMessage !== "") {
			console.error(errorMessage);
			return;
		}

		var formData = {
			id: idAcc,
			tentaikhoan: Updatetentaikhoan,
			matkhau: Updatematkhau,
			email: Updateemail,
		}

		console.log(formData);
		fetch('http://localhost/test_web_mvc/api/account/update.php', {
			method: 'PUT',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify(formData)
		})
			.then(response => {
				return response.json();
			})
			.then(data => {
				getAccount(renderAccount);
			})
			.catch(error => { });
		console.log(formData);
	});
}

function deleteAccount(idAcc) {
	if (confirm("Bạn có chắc chắn thực hiện hành động không") !== true) {
		return; // Exit the function if user cancels
	}

	fetch('http://localhost/test_web_mvc/api/account/delete.php', {
		method: 'DELETE',
		headers: {
			'Content-Type': 'application/json'
		},
		body: JSON.stringify({ id: idAcc })
	})
		.then(response => {
			return response.json();
		})
		.then(data => {
			if (data.message === 'account da duoc xoa thanh cong') {
				alert('Thực hiện xoá tài khoản thành công');
				getAccount(renderAccount);
			} else {
				alert('sai!!!');
			}
		})
		.catch(error => { });
}

function createAccount() {
	var btnCreate = document.querySelector('#btnCreate');

	btnCreate.addEventListener('click', () => {
		var check = false;

		var tentaikhoan = document.querySelector('input[name="tentaikhoan"]').value;
		var matkhau = document.querySelector('input[name="matkhau"]').value;
		var email = document.querySelector('input[name="email"]').value;

		if (tentaikhoan.length > 0 && matkhau.length > 0 && email.length > 0) {
			check = true;
		}
		else {
			check = false;
		}
		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		if (!emailRegex.test(email)) {
			check = false;
			errorMessage = "Email không hợp lệ. Vui lòng nhập đúng định dạng (e.g., example@domain.com).\n";
			console.log(errorMessage);
		}

		if (check == true) {

			var formData = {
				tentaikhoan: tentaikhoan,
				matkhau: matkhau,
				email: email,
			}

			fetch('http://localhost/test_web_mvc/api/account/create.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(formData)
			})
				.then(response => {
					return response.json();
				})
				.then(data => {
					if (data.message === 'account moi da duoc tao thanh cong') {
						alert('Tạo mới tài khoản thành công');
						document.querySelector('input[name="tentaikhoan"]').value = "";
						document.querySelector('input[name="matkhau"]').value = "";
						document.querySelector('input[name="email"]').value = "";

						getAccount(renderAccount);
					}
				})
				.catch(error => { });
			console.log(formData);
		}
	});
}

btnDangxuat.addEventListener('click', ()=>{
	if (confirm("Xác nhận đăng xuất?") !== true) {
		return; // Exit the function if user cancels
	}
	localStorage.removeItem('tentaikhoanAdmin');
	window.location.href = "login.html";
})