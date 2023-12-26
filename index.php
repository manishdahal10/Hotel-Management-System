<?php
  session_start();
  include "topnav.php";
?>
 <style>
    /* home */

    .home{
        padding: 0;
    }

    .home .slide{
        min-height: 100vh;
        background-size: cover !important;
        background-position: center !important;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: -1;
    }

    .home .slide .content{
        width: 80rem;
        text-align: center;
    }

    .home .slide .content h3{
        font-size: 4rem;
        text-transform: uppercase;
        color: var(--white);
        line-height: 1.1;
        padding: 2rem 0;
    }

    .swiper-button-next,
    .swiper-button-prev{
        height: 5rem;
        width: 5rem;
        line-height: 5rem;
        background: var(--white);
        color: var(--black);
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover{
        background: var(--primary);
        color: var(--white);
    }

    .swiper-button-next::after,
    .swiper-button-prev::after{
        font-size: 2rem;
    }

    /* end */

    /* availability */

    .availability form{
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        background: #eee;
        padding: 2rem;
        border-radius: .5rem;
    }

    .availability form .box{
        flex: 1 1 20rem;
    }

    .availability form .box p{
        font-size: 2rem;
        color: var(--primary);
    }

    .availability form .box .input{
        width: 100%;
        padding: 1rem;
        font-size: 1.8rem;
        color: var(--black);
        margin: 1rem 0;
        border-radius: .5rem;
    }

    /* end */
    /* gallery */

    .gallery .slide{
        height: 50rem;
        position: relative;
        overflow: hidden;
        margin-bottom: 40px;
    }

    .gallery .slide img{
        height: 100%;
        width: 100%;
        object-fit: cover;
    }

    /* .gallery .slide .icon{
        display: none;
        align-items: center;
        justify-content: center;
        position: absolute;
        top: 0; left: 0;
        z-index: 10;
        height: 100%;
        width: 100%;
        background: rgba(0, 0, 0, 0.5);
    }

    .gallery .slide .icon i{
        font-size: 6rem;
        color: var(--white);
    }

    .gallery .slide:hover .icon{
        display: flex;
    } */

    /* end */

    /* review */

    .review{
        background-image: url("images/review.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        height: 48rem;
        position: relative;
        margin: 4rem 0;
    }

    .review .review-slider{
        background: var(--secondary);
        padding: 2rem;
        width: 50%;
        height: 145%;
        margin-top: -8rem;
        margin-right: 60rem;
        padding-top: 6%;
        color: var(--white);
        box-shadow: var(--box-shadow);
    }

    .review .slide{
        text-align: center;
    }

    .review .slide .heading{
        color: var(--white);
    }

    .review .slide i{
        font-size: 6rem;
        color: var(--primary);
    }

    .review .slide p{
        padding-bottom: 1.5rem;
        padding-top: 3rem;
        font-size: 1.5rem;
        line-height: 1.8;
        color: var(--white);
    }

    .review .slide .user{
        display: flex;
        gap: 1.5rem;
        align-items: center;
        justify-content: center;
        padding: 1rem 0;
        border-radius: .5rem;
    }


    .review .slide .user img{
        height: 7rem;
        width: 7rem;
        border-radius: 15%;
        object-fit: cover;
    }

    .review .slide .user h3{
        font-size: 2rem;
        color: var(--black);
        padding-bottom: .5rem;
    }

    .review .slide .user i{
        font-size: 1.3rem;
        color: var(--primary);
    }

    /* end */

  /* faq */

  .faqs .row{
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      align-items: center;
  }

  .faqs .row .image{
      flex: 1 1 40rem;
  }

  .faqs .row .image img{
      width: 100%;
  }

  .faqs .row .content{
      flex: 1 1 40rem;
  }

  .faqs .row .content .box{
      margin-top: 2rem;
  }

  .faqs .row .content .box h3{
      font-size: 2rem;
      color: var(--primary);
      padding: 1.5rem;
      cursor: pointer;
  }

  .faqs .row .content .box p{
      font-size: 1.6rem;
      padding: 1.5rem 2rem;
      line-height: 2;
      color: var(--secondary);
      box-shadow: var(--box-shadow);
      display: none;
  }

  .faqs .row .content .box.active p{
      display: inline-block;
  }

  /* end */




  /* services */

  .services .box-container{
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(16rem,1fr));
      gap: 2rem;
  }

  .services .box-container .box{
      text-align: center;
  }

  .services .box-container .box img{
      height: 10rem;
      margin-bottom: .7rem;
  }

  .services .box-container .box h3{
      font-size: 1.7rem;
      color: var(--black);
      padding: .5rem 0;
  }

  /* end */

  /* about */

  .about .row{
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 6rem;
  }

  .about .row .image{
      flex: 1 1 30rem;
  }

  .about .row .image img{
      width: 100%;
  }

  .about .row .content{
      flex: 1 1 51rem;
  }

  .about .row .content h3{
      font-size: 3.5rem;
      color: var(--primary);
      padding: 2rem 0;
  }

  .about .row .content p{
      font-size: 1.6rem;
      color: #666;
      padding: 1rem 0;
      line-height: 1.8;
  }

  /* end */
  /* reservation */

  .reservation form{
      padding: 2rem;
      border: .2rem solid rgba(0, 0, 0, 0.1);
      border-radius: 1.5rem;
      
  }

  .reservation form .container{
      display: flex;
      flex-wrap: wrap;
      gap: 1.5rem;
  }

  .reservation form .container .box{
      font-size: 1.8rem;
      width: 100%;
      padding: 1rem 0;
  }

  .reservation form .container .box p{
      font-size: 2.5rem;
      color: var(--primary);
  }

  .reservation form .container .box .input{
      font-size: 1.8rem;
      width: 100%;
      padding: 1rem 0;
      margin: 1rem 0;
      border-bottom: .2rem solid rgba(0, 0, 0, 0.1);
      color: var(--black);
  }

  /* end */
  /* Footer Styles */
  .footer {
    background-color: #fff;
    color: var(--primary);
    padding: 40px 0;
  }

  .footer-row {
    display: flex;
    justify-content: space-between;
  }

  .footer-col {
    flex: 1;
    padding: 10px;
  }

  .footer-map {
    max-width: 100%;
    height: 30rem;
    margin-left:150px;
  }

  .footer-contact h2,
  .footer-hotel-details h2 {
    font-size: 2.5rem;
    margin-bottom: 10px;
  }

  .footer-contact p,
  .footer-hotel-details p {
    font-size: 1.6rem;
    margin-bottom: 5px;
  }

  .footer-social-icons a {
    color: #fff;
    font-size: 2.5rem;
    margin-right: 10px;
    transition: color 0.3s ease-in-out;
  }

  .footer-social-icons a:hover {
    color: #f39c12;
  }

 </style>
   <!-- home -->

    <section class="home" id="home">

      <div class="swiper home-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide" style="background: url(images/home-slide1.jpg) no-repeat;">
               <div class="content">
                  <h3>Welcome to Our Hotel</h3>
                  <a href="newroom.php" class="btn"> Book Now</a>
               </div>
            </div>

            <div class="swiper-slide slide" style="background: url(images/home-slide2.jpg) no-repeat;">
               <div class="content">
                  <h3>Book your desired Room </h3>
                  <a href="newroom.php" class="btn"> Book Now</a>
               </div>
            </div>

            <div class="swiper-slide slide" style="background: url(images/home-slide3.jpg) no-repeat;">
               <div class="content">
                  <h3>Spend your holiday with quality time with us</h3>
                  <a href="newroom.php" class="btn"> Book Now</a>
               </div>
            </div>

            <div class="swiper-slide slide" style="background: url(images/home-slide4.jpg) no-repeat;">
               <div class="content">
                  <h3>it's where  your dreams come true</h3>
                  <a href="newroom.php" class="btn"> Book Now</a>
               </div>
            </div>

         </div>

         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>

      </div>

   </section>

   <!-- end -->

   

   <!----aboutus---->
<section class="about" id="about">
      <div class="row">
      <?php
      include 'config.php';
      $query = "SELECT * FROM about_us";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
    ?>
    <div class="image">
    <img src="./admin/uploaded_img/<?php echo $row['about_image']; ?>" alt="About Us Image">
    </div>
    <div class="content">
      <h3><?php echo $row['about_title']; ?></h3>
      <p><?php echo $row['about_content']; ?></p>
    </div>
  </div>
</section>

<!------end----->


<section class="gallery" id="gallery">
  <h1 class="heading">our gallery</h1>

  <div class="swiper gallery-slider">
    <div class="swiper-wrapper">
      <?php
      include 'config.php';
      $query = "SELECT * FROM gallery";
      $result = mysqli_query($conn, $query);

      while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="swiper-slide slide">
          <img src="./admin/uploaded_img/<?php echo $row['gallery_image']; ?>" alt="" />
          <div class="icon">
            <i class="fas fa-magnifying-glass-plus"></i>
          </div>
        </div>
      <?php
      }

      // Close the database connection
      mysqli_close($conn);
      ?>
    </div>
  </div>
</section>


 <!-- end -->
   <!-- services -->
   <h1 class="heading">our services</h1>
   <section class="services" id="services">
      <div class="box-container">
        <div class="box">
          <img src="images/service1.png" alt="" />
          <h3>swimming pool</h3>
        </div>

        <div class="box">
          <img src="images/service2.png" alt="" />
          <h3>food & drink</h3>
        </div>

        <div class="box">
          <img src="images/service3.png" alt="" />
          <h3>restaurant</h3>
        </div>

        <div class="box">
          <img src="images/service4.png" alt="" />
          <h3>fitness</h3>
        </div>

        <div class="box">
          <img src="images/service5.png" alt="" />
          <h3>beauty spa</h3>
        </div>

        <div class="box">
          <img src="images/service6.png" alt="" />
          <h3>resort beach</h3>
        </div>
      </div>
    </section>
    <!-- end -->

<!-- contact -->
<section class="reservation" id="reservation">
      <h1 class="heading">Contact</h1>
        <form action="contact_process.php" method="POST">
        <div class="container">
          <div class="box">
            <p>Name <span>*</span></p>
            <input type="text" class="input" placeholder="Your Name" name="name" required />
          </div>

          <div class="box">
            <p>Email <span>*</span></p>
            <input type="email" class="input" placeholder="Your Email" name="email" required />
          </div>

          <div class="box">
            <p>Phone <span>*</span></p>
            <input type="tel" class="input" placeholder="Your Phone" name="phone" required />
          </div>

          <div class="box">
            <p>Address <span>*</span></p>
            <input type="text" class="input" placeholder="Your Address" name="address" required />
          </div>

          <div class="box">
            <p>Message <span>*</span></p>
            <textarea class="input" placeholder="Your Message" name="message" required></textarea>
          </div>

          <input type="submit" value="Send" class="btn" />
        </form>
      </div>
     
</section>
<!-- end -->

<footer class="footer">
  <div class="container">
    <div class="footer-row">
      <div class="footer-col footer-col-map">
        <!-- Map Image -->
        <img src="images/footer-map.png" alt="Map Image" class="footer-map" />
      </div>
      <div class="footer-col footer-col-content">
        <!-- Contact Information -->
        <div class="footer-contact">
          <h2>Contact Us</h2>
          <p><i class="fas fa-phone"></i> +977 1234567890</p>
          <p><i class="fas fa-envelope"></i> mail@ourhotel.com</p>
          <p><i class="fas fa-map-marker-alt"></i> 123street, Ktm, Nepal</p>
        </div>
        
        <!-- Hotel Details -->
        <div class="footer-hotel-details">
          <h2><i class="fas fa-hotel"></i> Hotel Management System</h2>
          <p>Spend Your Holiday With Us.</p>
        </div>
        
        <!-- Social Icons -->
        <div class="footer-social-icons">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>




   <!-- end -->
   <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
   <script>
      let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () => {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
}

window.onscroll = () => {
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
}

var swiper = new Swiper(".home-slider", {
    grabCursor:true,
    loop:true,
    centeredSlides:true,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

var swiper = new Swiper(".room-slider", {
    spaceBetween: 20,
    grabCursor:true,
    loop:true,
    centeredSlides:true,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        991: {
            slidesPerView: 3,
        },
    },
});

var swiper = new Swiper(".gallery-slider", {
    spaceBetween: 10,
    grabCursor:true,
    loop:true,
    centeredSlides:true,
    autoplay: {
        delay: 1500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 3,
        },
        991: {
            slidesPerView: 4,
        },
    },
});

var swiper = new Swiper(".review-slider", {
    spaceBetween: 10,
    grabCursor:true,
    loop:true,
    centeredSlides:true,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

let accordions = document.querySelectorAll('.faqs .row .content .box');

accordions.forEach(acco =>{
    acco.onclick = () =>{
        accordions.forEach(subAcco => {subAcco.classList.remove('active')});
        acco.classList.add('active');
    }
})



</script>