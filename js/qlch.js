const addForm = document.getElementById("add-user-form");
const editForm = document.getElementById("edit-user-form");
const tbody = document.querySelector("tbody");

start();

function start() {
	getCauhoi(renderCauhoi);
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

function getCauhoi(data) {
	fetch('http://localhost/test_web_mvc/api/question/getData.php')
		.then(res => res.json())
		.then(data)
}

function renderCauhoi(data) {
	console.log(data);

	let htmlString = "";

	data.map(function (item, index) {
		htmlString += `
			<tr>
				<td>${index + 1}</td>
				<td>${item.title}</td>
				<td>${item.cau_a}</td>
				<td>${item.cau_b}</td>
				<td>${item.cau_c}</td>
				<td>${item.cau_d}</td>
				<td>${item.cau_dung}</td>
				<td>${item.id_danhmuc}</td>
				<td>
					<button class="btn btn-success btn-sm rounded-pill py-0 editLink" data-toggle="modal" data-target="#editUserModal" onclick="updateCauhoi(${item.id})">Sửa</button>
					<button class="btn btn-danger btn-sm rounded-pill py-0 deleteLink" onclick="deleteCauhoi(${item.id})">Xoá</button>
				</td>
			</tr>
		`;
	});

	tbody.innerHTML = htmlString;
}

function updateCauhoi(idCh) {
	console.log(idCh);

	var btnEdit = document.querySelector('#btnEdit');

	btnEdit.addEventListener('click', () => {

		var Updatetitle = document.querySelector('input[name="Updatetitle"]').value;
		var Updatecaua = document.querySelector('input[name="Updatecaua"]').value;
		var Updatecaub = document.querySelector('input[name="Updatecaub"]').value;
		var Updatecauc = document.querySelector('input[name="Updatecauc"]').value;
		var Updatecaud = document.querySelector('input[name="Updatecaud"]').value;
		var Updatecaudung = document.querySelector('input[name="Updatecaudung"]').value;
		var Updateidch = document.querySelector('input[name="Updateidch"]').value;

		let errorMessage = ""; // Initialize error message

		if (title === "" || cau_a === "" || cau_b === "" || cau_c === "" || cau_d === "" || cau_dung === "" || id_danhmuc === "") {
			errorMessage = "Vui lòng nhập đầy đủ thông tin!).\n";
		}

		if (errorMessage !== "") {
			console.error(errorMessage);
			return;
		}

		var formData = {
			id: idCh,
			title: Updatetitle,
			cau_a: Updatecaua,
			cau_b: Updatecaub,
			cau_c: Updatecauc,
			cau_d: Updatecaud,
			cau_dung: Updatecaudung,
			id_danhmuc: Updateidch,
		}

		console.log(formData);
		fetch('http://localhost/test_web_mvc/api/question/update.php', {
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
				getCauhoi(renderCauhoi);
			})
			.catch(error => { });
		console.log(formData);
	});
}

function deleteCauhoi(idCh) {
	if (confirm("Bạn có chắc chắn thực hiện hành động không") !== true) {
		return; // Exit the function if user cancels
	}

	fetch('http://localhost/test_web_mvc/api/question/delete.php', {
		method: 'DELETE',
		headers: {
			'Content-Type': 'application/json'
		},
		body: JSON.stringify({ id: idCh })
	})
		.then(response => {
			return response.json();
		})
		.then(function () {
			getCauhoi(renderCauhoi);
		})
		.catch(error => { });
}

function createAccount() {
	var btnCreate = document.querySelector('#btnCreate');

	btnCreate.addEventListener('click', () => {
		var check = false;

		var title = document.querySelector('input[name="title"]').value;
		var cau_a = document.querySelector('input[name="cau_a"]').value;
		var cau_b = document.querySelector('input[name="cau_b"]').value;
		var cau_c = document.querySelector('input[name="cau_c"]').value;
		var cau_d = document.querySelector('input[name="cau_d"]').value;
		var cau_dung = document.querySelector('input[name="cau_dung"]').value;
		var id_danhmuc = document.querySelector('input[name="id_danhmuc"]').value;

		if (title.length > 0 && cau_a.length > 0 && cau_b.length > 0 && cau_c.length > 0 && cau_d.length > 0 && cau_dung.length > 0 && id_danhmuc.length > 0) {
			check = true;
		}
		else {
			check = false;
		}

		if (check == true) {

			var formData = {
				title: title,
				cau_a: cau_a,
				cau_b: cau_b,
				cau_c: cau_c,
				cau_d: cau_d,
				cau_dung: cau_dung,
				id_danhmuc: id_danhmuc,
			}

			fetch('http://localhost/test_web_mvc/api/question/create.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(formData)
			})
				.then(response => {
					return response.json();
				})
				.then(function () {
					getCauhoi(renderCauhoi);
				})
				.catch(error => { });
			console.log(formData);
		}
	});
}