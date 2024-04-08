const addForm = document.getElementById("add-user-form");
const editForm = document.getElementById("edit-user-form");
const tbody = document.querySelector("tbody");
const btnDangxuat = document.getElementById('dangxuat');

start();

function start() {
	getDanhmuc(renderDanhmuc);
	createDanhmuc();
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

function getDanhmuc(data) {
	fetch('http://localhost/test_web_mvc/api/danhmuc/read.php')
		.then(res => res.json())
		.then(data)
}

function renderDanhmuc(data) {
	console.log(data);

	let htmlString = "";

	data.map(function (item, index) {
		htmlString += `
			<tr>
				<td>${index + 1}</td>
				<td class="tendm">${item.tendanhmuc}</td>
				<td>
					<button class="btn btn-success btn-sm rounded-pill py-0 editLink" data-toggle="modal" data-target="#editUserModal" onclick="updateDanhmuc(${item.id})">Sửa</button>
					<button class="btn btn-danger btn-sm rounded-pill py-0 deleteLink" onclick="deleteDanhmuc(${item.id})">Xoá</button>
				</td>
			</tr>
		`;
	});

	tbody.innerHTML = htmlString;
}

function updateDanhmuc(idDM) {
	console.log(idDM);

	var btnEdit = document.querySelector('#btnEdit');
	
	fetch(`http://localhost/test_web_mvc/api/danhmuc/show.php?id=${idDM}`)
    .then(res => res.json())
    .then(data => {
		console.log(data.message);
		const tendm = data.message;
      	document.querySelector('input[name="Updatetendanhmuc"]').value = tendm;
    })
    .catch(error => console.error(error));

	btnEdit.addEventListener('click', () => {

		var Updatetendanhmuc = document.querySelector('input[name="Updatetendanhmuc"]').value;

		let errorMessage = ""; // Initialize error message

		if (Updatetendanhmuc === "") {
			errorMessage = "Vui lòng nhập đầy đủ thông tin danh mục.\n";
			console.error(errorMessage);
			return;
		}

		var formData = {
			id: idDM,
			tendanhmuc: Updatetendanhmuc,
		}

		console.log(formData);
		fetch('http://localhost/test_web_mvc/api/danhmuc/update.php', {
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
				if (data.message === 'danhmuc da duoc cap nhat thanh cong') {
					alert('Cập nhật thành công');
					getDanhmuc(renderDanhmuc);
				} else {
					alert('Tên danh mục không được trùng');
				}
			})
			.catch(error => { });
	});
}

function deleteDanhmuc(idDM) {
	if (confirm("Xác nhận xoá danh mục?") !== true) {
		return; // Exit the function if user cancels
	}

	fetch('http://localhost/test_web_mvc/api/danhmuc/delete.php', {
		method: 'DELETE',
		headers: {
			'Content-Type': 'application/json'
		},
		body: JSON.stringify({ id: idDM })
	})
		.then(response => {
			return response.json();
		})
		.then(function () {
			getDanhmuc(renderDanhmuc);
		})
		.catch(error => { });
}

function createDanhmuc() {
	var btnCreate = document.querySelector('#btnCreate');

	btnCreate.addEventListener('click', () => {
		var check = false;

		var tendanhmuc = document.querySelector('input[name="tendanhmuc"]').value;

		if (tendanhmuc.length > 0) {
			check = true;
		}
		else {
			check = false;
		}

		if (check == true) {

			var formData = {
				tendanhmuc: tendanhmuc,
			}

			fetch('http://localhost/test_web_mvc/api/danhmuc/create.php', {
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
					if (data.message === 'danhmuc moi da duoc tao thanh cong') {
						alert('Tạo mới danh mục thành công!');
						getDanhmuc(renderDanhmuc);
					} else {
						alert('Tạo danh mục mới thất bại!!!');
					}
					// getDanhmuc(renderDanhmuc);
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