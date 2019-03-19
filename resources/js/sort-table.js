// Attach event listeners to table headers
const headers = document.getElementsByClassName('js-product-table-sortable-column');
for (let i = 0; i < headers.length; i++) {
	headers[i].addEventListener('click', sortTable);
}

function sortTable (event) {
	const ASC = "asc";
	const DESC = "desc";
	
	const target = event.currentTarget;
	
	// Get column index from clicked cell
	const cellIndex = target.cellIndex;
	
	// Swap sort order
	let order = 1;
	if (target.dataset.sort == ASC) {
		order = -1;
		target.dataset.sort = DESC
	} else {
		order = 1;
		target.dataset.sort = ASC
	}

	// Convert HTMLCollection to array for sorting
	const table = target.parentElement.parentElement.parentElement;
	let rows = [...table.tBodies[0].children];

	// Sort rows
	rows.sort((rowA, rowB) => {
		let dataA = rowA.children[cellIndex].innerText.replace(/\W/g, '');
		let dataB = rowB.children[cellIndex].innerText.replace(/\W/g, '');

		dataA = Number(dataA) || dataA;
		dataB = Number(dataB) || dataB;
		
	
		if (dataA < dataB) {
			return -1 * order;
		} 
		
		if (dataA > dataB) {
			return 1 * order;
		}
	
		return 0;
	});
	
	// Add sorted nodes back to DOM
	const parent = rows[0].parentElement;
	for (let i = 0; i < rows.length; i++) {
		const detachedRow = parent.removeChild(rows[i]);
		parent.appendChild(detachedRow);
	}
}
