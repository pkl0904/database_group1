


const paginationNumbers = document.getElementById("pagination-numbers");
const paginatedList = document.getElementById("paginated-list");
const listItems = paginatedList.querySelectorAll("tr");
const nextButton = document.getElementById("next-button");
const prevButton = document.getElementById("prev-button");

const paginationLimit = 7;
const pageCount = Math.ceil(listItems.length / paginationLimit);
let currentPage = 1;

const disableButton = (button) => {
  button.classList.add("disabled");
  button.setAttribute("disabled", true);
};

const enableButton = (button) => {
  button.classList.remove("disabled");
  button.removeAttribute("disabled");
};

const handlePageButtonsStatus = () => {
  if (currentPage === 1) {
    disableButton(prevButton);
  } else {
    enableButton(prevButton);
  }

  if (pageCount === currentPage) {
    disableButton(nextButton);
  } else {
    enableButton(nextButton);
  }
};

const handleActivePageNumber = () => {
  document.querySelectorAll(".pagination-number").forEach((button) => {
    button.classList.remove("active");
    const pageIndex = Number(button.getAttribute("page-index"));
    if (pageIndex == currentPage) {
      button.classList.add("active");
    }
  });
};

const appendPageNumber = (index) => {
  const pageNumber = document.createElement("button");
  pageNumber.className = "pagination-number";
  pageNumber.innerHTML = index;
  pageNumber.setAttribute("page-index", index);
  pageNumber.setAttribute("aria-label", "Page " + index);

  paginationNumbers.appendChild(pageNumber);
};

const getPaginationNumbers = () => {
  for (let i = 1; i <= pageCount; i++) {
    appendPageNumber(i);
  }
};

const setCurrentPage = (pageNum) => {
  currentPage = pageNum;

  handleActivePageNumber();
  handlePageButtonsStatus();
  
  const prevRange = (pageNum - 1) * paginationLimit;
  const currRange = pageNum * paginationLimit;

  listItems.forEach((item, index) => {
    item.classList.add("hidden");
    if (index >= prevRange && index < currRange) {
      item.classList.remove("hidden");
    }
  });
};

window.addEventListener("load", () => {
  getPaginationNumbers();
  setCurrentPage(1);

  prevButton.addEventListener("click", () => {
    setCurrentPage(currentPage - 1);
  });

  nextButton.addEventListener("click", () => {
    setCurrentPage(currentPage + 1);
  });

  document.querySelectorAll(".pagination-number").forEach((button) => {
    const pageIndex = Number(button.getAttribute("page-index"));

    if (pageIndex) {
      button.addEventListener("click", () => {
        setCurrentPage(pageIndex);
      });
    }
  });
});







// Lấy đối tượng modal
var modal = document.getElementById("myModal");

// Lấy đối tượng button để mở modal
var btn = document.getElementById("import-btn");

// Lấy đối tượng button để đóng modal
var span = document.getElementsByClassName("close-btn")[0];

// Khi người dùng click vào button, mở modal
btn.onclick = function () {
  modal.style.display = "block";
};

// Khi người dùng click vào nút đóng (x), đóng modal
span.onclick = function () {
  modal.style.display = "none";
};

// Khi người dùng click bất kỳ đâu ngoài modal, đóng modal
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

// Khởi tạo đối tượng DataTable
$(document).ready(function () {
  $("#customer-table").DataTable();
});

document.body.classList.add("overlay");
var popup = document.createElement("div");
popup.classList.add("popup");
document.body.appendChild(popup);

const importButton = document.getElementById("import-button");
const closeButton = document.getElementById("close-btn");
const popupForm = document.querySelector(".popup-form");

importButton.addEventListener("click", function () {
  popupForm.style.display = "block";
});

closeButton.addEventListener("click", function () {
  popupForm.style.display = "none";
});
document.getElementById("close-btn").addEventListener("click", function () {
  document.getElementById("model-content").style.display = "block";
});

document.getElementById("close-btn").addEventListener("click", function () {
  document.getElementById("model-content").style.display = "none";
});
// Tạo danh sách các option trong dropbox Product ID
var productIDSelect = document.getElementById("productID");
for (var i = 1; i <= 50; i++) {
  var option = document.createElement("option");
  option.value = "Product" + i;
  option.text = "Product " + i;
  productIDSelect.add(option);
}

// Tạo mảng chứa thông tin về các sản phẩm

function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search-bar");
  filter = input.value.toUpperCase();
  table = document.getElementById("table-data");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
