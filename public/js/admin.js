$(document).ready(() => {
  const urlroot = "http://localhost/RemoteJobs/";

  $.ajax({
    url: `${urlroot}admin/users`,
    method: "GET",
    dataType: "json",
    success: data => {
      console.log(data);
    },
    error: err => {
      console.log(err);
    }
  });
});
