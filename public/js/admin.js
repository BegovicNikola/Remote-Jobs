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
  };

  const deleteUser = id => {
    $.ajax({
      url: `${urlroot}offers/delete/${id}`,
      method: "POST",
      success: data => {
        console.log(data);
      }
    });
  };

  const getOffersByUser = id => {
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

    $("#offersHolder").html(html);

    $(".fa-trash").click(event => deleteOffer(event.target.dataset.id));
  };

  const deleteOffer = id => {
    $.ajax({
      url: `${urlroot}offers/delete/${id}`,
      method: "POST",
      success: data => {
        console.log(data);
      }
    });
  };
});
