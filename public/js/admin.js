$(document).ready(() => {
  const urlroot = "http://localhost/RemoteJobs/";

  getAllUsers();

  function getAllUsers() {
    $.ajax({
      url: `${urlroot}admin/users`,
      method: "GET",
      dataType: "json",
      success: data => {
        allUsersRender(data);
      },
      error: err => {
        console.log(err);
      }
    });
  }

  const allUsersRender = users => {
    let html = "";

    users.forEach(user => {
      html += `
        <div class="d-flex justify-content-between align-items-center border-bottom my-3">
          <h4 class="mb-0">${user.name}</h4>
          <div class="d-flex align-items-center">
            <span class="fa fa-folder-open text-primary" data-id="${
              user.id
            }"></span>
            <span class="fa fa-times-circle text-danger ml-3" data-id="${
              user.id
            }"></span>
          </div>
        </div>
      `;
    });

    $("#usersHolder").html(html);

    $(".fa-folder-open").click(event =>
      getOffersByUser(event.target.dataset.id)
    );

    $(".fa-times-circle").click(deleteUser);
  };

  const deleteUser = event => {
    const id = event.target.dataset.id;
    $.ajax({
      url: `${urlroot}users/delete/${id}`,
      method: "POST",
      success: data => {
        getAllUsers();
        $("#offersHolder").html(`
            <p class="card-text text-center">
                No items to show<br/>
                Please select folder icon next to the user
            </p>
        `);
      }
    });
  };

  const getOffersByUser = id => {
    localStorage.setItem("user", id);
    $.ajax({
      url: `${urlroot}admin/offers/${id}`,
      method: "GET",
      dataType: "json",
      success: data => {
        offersByUserRender(data);
      },
      error: err => {
        console.log(err);
      }
    });
  };

  const offersByUserRender = offers => {
    let html = "";

    if (offers.length == 0) {
      html += `
        <p class="card-text text-center">
          No offers by this user
        </p>
      `;
    } else {
      offers.forEach(offer => {
        html += `
        <div class="d-flex justify-content-between align-items-center border-bottom my-3">
          <h4 class="mb-0">${offer.title}</h4>
          <div class="d-flex align-items-center">
            <a href="${urlroot}offers/job/${
          offer.id
        }"><span class="fa fa-folder text-primary"></span>
            </a>
            <span class="fa fa-trash text-danger ml-3" data-id="${
              offer.id
            }"></span>
          </div>
        </div>
        `;
      });
    }

    $("#offersHolder").html(html);

    $(".fa-trash").click(deleteOffer);
  };

  const deleteOffer = event => {
    const id = event.target.dataset.id;
    const user = localStorage.getItem("user");
    $.ajax({
      url: `${urlroot}offers/delete/${id}`,
      method: "POST",
      success: data => {
        getOffersByUser(user);
      },
      error: err => {
        console.log(err);
      }
    });
  };
});
