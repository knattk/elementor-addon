function VideoReceiver() {
        const string = {
            lastestSwiperSlide : ".redirect-start",
        }

        /**
         * Generate video from localstorage
         * 
         */

        const localStorageInit = () => {
            let contentFallbackData = window.localStorage.getItem("contentFallbackObj")? JSON.parse(window.localStorage.getItem("contentFallbackObj")) : null;
            let contentPackageData = window.localStorage.getItem("contentPackageObj")? JSON.parse(window.localStorage.getItem("contentPackageObj")) : contentFallbackData;

            if (contentFallbackData.role === "render" ){
                contentPackageData = contentFallbackData;
                return contentPackageData;
            } else {
                contentPackageData = window.localStorage.getItem("contentPackageObj")? JSON.parse(window.localStorage.getItem("contentPackageObj")) : contentFallbackData;
                return contentPackageData;
            }
        }
        localStorageInit ();

        const contentGenerator = () => {
            let contentPackageData = localStorageInit();
            let swiperVideo = document.querySelector("#swiper-video");
            let contentData = contentPackageData.content;
            let redirectTarget = contentPackageData.target;
            console.log(swiperVideo)
            // Get contents from ${contentPackageData.content}
            const videoGenerator = () => {
                contentData.forEach((content,index) => {
                    let createDiv = document.createElement("div");
                    // Check type of data
                    switch (content.type) {
                        case "video":
                            if (content.src.length) {
                                createDiv.className = 'swiper-slide';
                                createDiv.id = content.id;
                                createDiv.innerHTML = ` <div class="content-wrapper">
                                                                <video class="elementor-video" src="${content.src}" controls="" controlslist="nodownload nofullscreen noremoteplayback" playsinline="" loop="true" poster="${content.poster}"></video>      
                                                        </div>`;
                                swiperVideo.append(createDiv);
                            }
                            break;
                        case "image":
                            createDiv.className = 'swiper-slide';
                            createDiv.id = content.id;
                            createDiv.innerHTML = ` <div class="content-wrapper">
                                                        <img src="${content.src}"      
                                                    </div>`;
                            swiperVideo.append(createDiv);
                            break;
                        default:
                            break;
                    }
                }); 
            }
            

            // Create warning text after videos
            const redirectGenerator = () => {
                let createDiv = document.createElement("div");
                createDiv.className = 'swiper-slide redirect-start';
                createDiv.innerHTML = redirectTarget.description;
                swiperVideo.append(createDiv);
            }

            (async () => {
                await videoGenerator();
                await redirectGenerator();
            })()
        }


        const targetSetup = () => {
            let contentPackageData = localStorageInit();
            let target = contentPackageData.target;
            let targetClass = target && target.class? target.class : "redirect-start";
            let targetUrl = target && target.url? target.url : "/redirect-portal";
            let targetDesc = target && target.description? target.description : "กำลังเปลี่ยนหน้า" ;

                // Last swiper slide
                if (targetClass) {
                    let lastestSwiperSlide = document.querySelector(string.lastestSwiperSlide);
                    if (!lastestSwiperSlide.classList.contains(targetClass)){
                        lastestSwiperSlide.classList.add(targetClass);
                    }
                    lastestSwiperSlide.innerHTML = targetDesc;
                }
                return targetUrl;
        }

        /**
         * Redirect
         * 
         */
         const redirectObserver = () => {
            let redirectSection = document.querySelector(".redirect-start");
            
                let observer = new IntersectionObserver((entries) => {
                        entries.forEach((entry) => {
                            if ( entry.intersectionRatio) {
                                console.log('redirectObserver')
                                setTimeout(()=>{
                                console.log(targetSetup())
                                location.assign(targetSetup());
                            }, 2500)
                            }
                        });
                    },
                    { threshold: 0.5 }
                );
                observer.observe(redirectSection);
        }


        /**
         * Swiper register 
         * 
         */
        const swiperRegister = () => {
            const swiper = new Swiper(".videoSwiper", {
                direction: "vertical",
                slidesPerView: 1,
                mousewheel: true,
                lazy: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });

            const urlAnchor = () => {
                const currentUrl = document.URL;
                const urlParts   = currentUrl.split('#');
                const anchor = (urlParts.length > 1) ? urlParts[1] : null;
                if (anchor){
                    const number = anchor[anchor.length - 1];
                    if (anchor){
                        swiper.slideTo(number - 1);
                    }
                }
            }
            urlAnchor();
        }
        

        const videoAutoPlay = () => {
            let videos = document.querySelectorAll("video");
            
            videos.forEach((video, index) => {
                video.setAttribute("playsinline", "");
                video.muted = true;
                let observer = new IntersectionObserver((entries) => {
                        entries.forEach((entry) => {
                            if ( entry.intersectionRatio && video.paused ) {
                                video.play();
                                // video.currentTime = 0;
                            } else {
                                video.pause();
                            }
                        });
                    },
                    { threshold: 0.5 }
                );
                observer.observe(video);
            });
        }

        /**
         * Mute button
         * 
         */
        const audioController = () => { 
            let button = document.querySelector(".audiocontrol");
            const videos = document.querySelectorAll("video");
            if (button && videos){
                button.addEventListener('click', (target)=>{
                    if (button.classList.contains('muted')){
                        button.classList.remove("muted");
                        button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M301.1 34.8C312.6 40 320 51.4 320 64V448c0 12.6-7.4 24-18.9 29.2s-25 3.1-34.4-5.3L131.8 352H64c-35.3 0-64-28.7-64-64V224c0-35.3 28.7-64 64-64h67.8L266.7 40.1c9.4-8.4 22.9-10.4 34.4-5.3zM412.6 181.5C434.1 199.1 448 225.9 448 256s-13.9 56.9-35.4 74.5c-10.3 8.4-25.4 6.8-33.8-3.5s-6.8-25.4 3.5-33.8C393.1 284.4 400 271 400 256s-6.9-28.4-17.7-37.3c-10.3-8.4-11.8-23.5-3.5-33.8s23.5-11.8 33.8-3.5z"></path></svg>';

                        videos.forEach((video) => {video.muted = false;})
                        console.log('muted')
                    } else {
                        button.classList.add("muted");
                        button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M301.1 34.8C312.6 40 320 51.4 320 64V448c0 12.6-7.4 24-18.9 29.2s-25 3.1-34.4-5.3L131.8 352H64c-35.3 0-64-28.7-64-64V224c0-35.3 28.7-64 64-64h67.8L266.7 40.1c9.4-8.4 22.9-10.4 34.4-5.3zM425 167l55 55 55-55c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-55 55 55 55c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-55-55-55 55c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l55-55-55-55c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0z"></path></svg>';

                        videos.forEach((video) => {video.muted = true;})
                        console.log("added")
                    }
                })
            }
        }

        /**
         * Dinamic video sizing
         * 
         */
        const documentHeight = () => {
            const doc = document.documentElement;
            doc.style.setProperty('--doc-height', `${window.innerHeight}px`)
            window.addEventListener('resize', (e) => {
                doc.style.setProperty('--doc-height', `${window.innerHeight}px`);
            })
        }

        const maxVideoHeight = () => {
            function resize () {
                const windowRatio = window.innerHeight/window.innerWidth;

                let videos = document.querySelectorAll("video");
                videos.forEach(video => {
                    let videoHeight = video.videoHeight;
                    let videoWidth = video.videoWidth;
                    let videoRatio = videoHeight/videoWidth;
                    if ( windowRatio < videoRatio){ //windowRatio <= 1.3 && 
                            let ratioDiff = (videoRatio - windowRatio) * 100;
                            video.parentElement.style.marginTop = '-' + ratioDiff + '%';
                    }
                });
            }
           
        }

        async function timeline () {
                console.log('timeline')
                await contentGenerator();
                await swiperRegister();
                await documentHeight();
                await maxVideoHeight();
                await targetSetup();
                await redirectObserver();
                await videoAutoPlay();
                await audioController();
            }
        timeline();
    
        

}


window.addEventListener("DOMContentLoaded", (event) => {
  jQuery(window).on("elementor/frontend/init", () => {
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/video-receiver.default",
      VideoReceiver
    );
  });
})
