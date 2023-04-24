<?php
include 'header.php';
require 'bdd.php';
if (isset($_POST['create_post'])) {
    /**
     * insert script of creating a post
     */
}
// get All posts from my database

?>
    <div class="main-content right-chat-active">

        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="row feed-body">
                    <div class="col-xl-8 col-xxl-9 col-lg-8">
                        <form method="post" class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3"
                              enctype="multipart/form-data">

                            <div class="card-body p-0">
                                <a href="#"
                                   class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center"><i
                                            class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>Create
                                    Post</a>
                            </div>
                            <div class="card-body p-0 mt-3 position-relative">
                                <figure class="avatar position-absolute ms-2 mt-1 top-5"><img
                                            src=""
                                            alt="image"
                                            class="shadow-sm rounded-circle w30">
                                </figure>
                                <input name="title"
                                       class="bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg"
                                       placeholder="What's your post title">
                                <textarea name="description"
                                          class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg"
                                          cols="30" rows="10" placeholder="What's on your mind?"></textarea>
                            </div>
                            <div class="card-body d-flex p-0 mt-0">
                                <label for="post-photos"
                                       class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4"><i
                                            class="font-md text-success feather-image me-2"></i><span class="d-none-xs">Photos</span></label>
                                <input type="file" name="photos" class="d-none" id="post-photos">
                                <button type="submit" class="ms-auto btn btn-sm btn-primary text-white"
                                        id="dropdownMenu4"
                                        name="create_post">Save
                                </button>
                            </div>
                        </form>
                        <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
                                <div class="card-body p-0 d-flex">
                                    <figure class="avatar me-3"><img
                                                src="images/profile-2.png"
                                                alt="image"
                                                class="shadow-sm rounded-circle w45"></figure>
                                    <h4 class="fw-700 text-grey-900 font-xssss mt-1">name <span
                                                class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">date de creation</span>
                                    </h4>
                                    <a href="#" class="ms-auto" id="dropdownMenu2" data-bs-toggle="dropdown"
                                       aria-expanded="false"><i
                                                class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg"
                                         aria-labelledby="dropdownMenu2" style="margin: 0px;">
                                            <a href="javascript:void" class="card-body p-0 d-flex delete-post"
                                               >
                                                <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                                                <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Delete <span
                                                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Delete your post</span>
                                                </h4>
                                            </a>
                                            <a href="" class="card-body p-0 d-flex edit-post mt-2">
                                                <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                                                <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4 ">Edit<span
                                                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Update your post informations</span>
                                                </h4>
                                            </a>
                                        <a href="javascript:void" class="card-body p-0 d-flex report-post"
                                           >
                                            <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4 ">Report <span
                                                        class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Report the post to the administration</span>
                                            </h4>
                                            <a/>
                                    </div>
                                </div>
                                <div class="card-body p-0 me-lg-5">
                                    <h4 class="fw-800">title of post</h4>
                                    <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">this is a description of post</p>
                                </div>
                                <div class="card-body d-block p-0">
                                    <div class="row ps-2 pe-2">
                                        <div class="col-xs-4 col-sm-4 p-1"><a
                                                    href="images/profile-2.png"
                                                    data-lightbox="roadtrip"><img
                                                        src="images/profile-2.png"
                                                        class="rounded-3 w-100"
                                                        alt="image"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include 'footer.php';
?>