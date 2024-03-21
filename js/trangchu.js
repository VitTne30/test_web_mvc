const list = document.querySelector(".list");

start();

function start(){
	loadDanhmuc(renderDanhmuc);
}

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