<link rel="stylesheet" href="<?php echo PARENT_FOLDER ?>/public/css/header.admin.css">

<nav class="navbar navbar-expand shadow mb-4 topbar static-top navbar-light sticky-top" style="background: #0b790b;">
    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars" style="color: #ffffff;"></i></button>
        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group"></div>
        </form>
        <ul class="navbar-nav flex-nowrap ms-auto">
            <input id="notifdataURL" value="<?php echo PARENT_FOLDER ?>/notification" type="text" hidden>

            <li class="nav-item dropdown no-arrow mx-1">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter"></span><i class="fas fa-bell  fa-fw" style="color: rgb(255,255,255);"></i></a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                        <h6 class="dropdown-header" style="background-color:var(--color-primary); border-color:var(--color-primary)">Notification</h6>
                        <div id="notifContainer"></div>

                    </div>
                </div>
                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
            </li>
            <div class="d-none d-sm-block topbar-divider"></div>
            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow "><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 small" style="color: #ffffff;">DNSC PIO Office</span><img class="border rounded-circle img-profile" alt="Smiling Woman in Short Hair with a Beautiful Smile" src="<?php echo PARENT_FOLDER ?>/public/img/dogs/image2.jpeg" width="32" height="32"></a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                        <a class="dropdown-item profileLink" href="<?php echo PARENT_FOLDER ?>/profile">
                            <i class="fas fa-user fa-sm fa-fw me-2 "></i>&nbsp;Profile
                        </a>
                        <!-- <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw me-2 "></i>&nbsp;Settings</a> -->
                        <!-- <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw me-2 "></i>&nbsp;Activity
                            log</a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" id="logOutBtn" style="cursor: pointer;">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 "></i>&nbsp;Logout
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script>
    const logOutBtn = document.querySelector("#logOutBtn")

    logOutBtn && logOutBtn.addEventListener('click', logOut);

    function toTitleCase(str) {
        return str.replace(/\w\S*/g, function(txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        });
    }

    function logOut() {
        Swal.fire({
            title: "Do you want to Log Out?",
            icon: 'question',
            confirmButtonColor: "#0B790B",
            showCancelButton: true,
            color: "#000000",
            confirmButtonText: "Yes",
            confirmButtonColor: "#bd2d2d",
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                let timerInterval;
                Swal.fire({
                    icon: 'success',
                    title: "Successfully logged-out!",
                    html: '<p>Redirecting to log-in page...</p>',
                    confirmButtonColor: "#0B790B",
                    timer: 2000,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '<?php echo PARENT_FOLDER; ?>/logout';
                    }
                });
            }
        });
    }

    function getRequestTypeString(t_r_type) {
        const typeMapping = {
            'POSTING': 'Posting Approval',
            'PHOTO': 'Request for Copies of Photo',
            'PIO': 'PIO Service Request'
        };
        return typeMapping[t_r_type] || t_r_type; // Default to original if not found
    }
    const notifdataURL = document.querySelector("#notifdataURL").value

    axios({
        method: 'post',
        url: notifdataURL,
        data: {
            'type': 'admin'
        },
    }).then(response => {
        var responseData = response.data.request;
        var notifContainer = document.querySelector("#notifContainer")
        var formLink = document.querySelector(".profileLink")
        var badgeCounter = document.querySelector(".badge-counter")
        var html = ''
        var count = 0

        formLink.setAttribute('href', formLink.getAttribute('href') + '?id=' + response.data.id);
        responseData.forEach(function(data) {



            if (data.t_viewedAdmin == 'Yes') {
                return;
            }
            const requestTypeString = getRequestTypeString(data.t_r_type);

            html +=

                '     <a class="dropdown-item d-flex align-items-center" href="<?php echo PARENT_FOLDER ?>/admin/request/view?id=' + data.t_r_id + '&type=' + data.t_r_type + '">' +
                '         <div class="dropdown-list-image me-3"><img class="rounded-circle" src="<?php echo PARENT_FOLDER ?>/public/img/dogs/image2.jpeg">' +
                '         </div>' +
                '         <div class="fw-bold">' +
                '             <div class="text-truncate " ;"><span> <strong>New ' + requestTypeString + ' </strong></span></div>' +
                '             <p class="small text-gray-900 mb-0"> <strong>' + toTitleCase(data.user_fn) + ' ' + toTitleCase(data.user_ln) + '  </strong><span class="small ">' +
                '               <p  style="" class="small text-gray-600 mb-0">' + data.t_output_status + '</p>' +
                '</span></p>' +
                '         </div>' +
                '     </a>'

            count++
        });

        // html += ''+
        //     ' <a class="dropdown-item text-center small text-gray-500" href="#">' +
        //     '                   Show All' +
        //     '                    Notifications' +
        //     '               </a>' 


        notifContainer.innerHTML = html
        badgeCounter.innerHTML = count
    }).catch(error => {
        console.error(error)
    })
</script>