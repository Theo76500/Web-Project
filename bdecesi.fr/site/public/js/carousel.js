class Carousel {
    constructor(element, options = {}) {
        this.element = element;
        this.options = Object.assign({}, {
            slidesToScroll: 1,
            slidesVisible: 1,
            pagination: false,
            navigation: true,
            infinite: false
        }, options)

        let children = [].slice.call(element.children)
        this.isMobile = false
        this.currentItem = 0;
        this.moveCallbacks = []
        this.offset = 0

        this.root = this.createDivWithClass('carousel')
        this.container = this.createDivWithClass('carousel__container')
        this.root.setAttribute('tabindex', '0')
        this.root.appendChild(this.container)
        this.element.appendChild(this.root)
        this.items = children.map((child) => {
            let item = this.createDivWithClass('carousel__item')
            item.appendChild(child)
            return item
        })

        if (this.options.infinite) {
            this.offset = this.options.slidesVisible + this.options.slidesToScroll
            if (this.offset > children.length) {
                console.error('Not enough elements in the carousel !', element)
            }
            this.items = [
                ...this.items.slice(this.items.length - (this.offset)).map(item => item.cloneNode(true)),
                        ...this.items,
                        ...this.items.slice(0, this.offset).map(item => item.cloneNode(true))
                ]
            this.gotoItem(this.offset, false)
        }

        this.items.forEach(item => this.container.appendChild(item))

        this.setStyle()

        if (this.options.navigation) {
            this.createNavigation()
        }

        if (this.options.pagination) {
            this.createPagination()
        }

        this.moveCallbacks.forEach(cb => cb(this.currentItem))
        this.onWindowResize()
        window.addEventListener('resize', this.onWindowResize.bind(this))
        this.root.addEventListener('keyup', (e) => {
            if (e.key === 'ArrowRight' || e.key === 'Right') {
                this.next()
            } else if (e.key === 'ArrowLeft' || e.key === 'Left') {
                this.prev()
            }
        })

        if (this.options.infinite) {
            this.container.addEventListener('transitionend', this.resetInfinite.bind(this))
        }
    }

    setStyle() {
        let ratio = this.items.length / this.slidesVisible
        this.container.style.width = (ratio * 100) + "%"
        this.items.forEach(item => item.style.width = ((100 / this.slidesVisible) / ratio) + "%")
    }

    createNavigation() {
        let nextButton = this.createDivWithClass('carousel__next')
        let prevButton = this.createDivWithClass('carousel__prev')

        let iNext = document.createElement('i')
        iNext.classList.add('fas')
        iNext.classList.add('fa-4x')
        iNext.classList.add('fa-chevron-circle-right')

        let iPrev = document.createElement('i')
        iPrev.classList.add('fas')
        iPrev.classList.add('fa-4x')
        iPrev.classList.add('fa-chevron-circle-left')

        prevButton.appendChild(iPrev)
        nextButton.appendChild(iNext)

        this.root.appendChild(nextButton)
        this.root.appendChild(prevButton)
        nextButton.addEventListener('click', this.next.bind(this))
        prevButton.addEventListener('click', this.prev.bind(this))

        this.onMove(index => {
            if (index === 0) {
                prevButton.classList.add('carousel__prev--hidden')
            } else {
                prevButton.classList.remove('carousel__prev--hidden')
            }

            if (this.items[this.currentItem + this.slidesVisible] === undefined) {
                nextButton.classList.add('carousel__next--hidden')
            } else {
                nextButton.classList.remove('carousel__next--hidden')
            }
        })
    }

    createPagination() {
        let pagination = this.createDivWithClass('carousel__pagination')
        let buttons = []
        this.root.appendChild(pagination)
        for (let i = 0; i < (this.items.length - 2 * this.offset); i = i + this.options.slidesToScroll) {
            let button = this.createDivWithClass('carousel__pagination__button')
            button.addEventListener('click', () => {
                this.gotoItem(i + this.offset)
            })
            pagination.appendChild(button)
            buttons.push(button)
        }
        this.onMove(index => {
            let count = this.items.length - 2 * this.offset
            let activeButton = buttons[Math.floor(((index - this.offset) % count) / this.options.slidesToScroll)]
            if (activeButton) {
                buttons.forEach(button => button.classList.remove('carousel__pagination__button--active'))
                activeButton.classList.add('carousel__pagination__button--active')
            }
        })
    }

    translate(percent) {
        this.container.style.transform = 'translate3d(' + percent + '%, 0, 0)'
    }

    next() {
        this.gotoItem(this.currentItem + this.slidesToScroll)
    }

    prev() {
        this.gotoItem(this.currentItem - this.slidesToScroll)
    }

    gotoItem(index, animation = true) {
        if (index < 0) {
            return;
        } else if (index >= this.items.length || (this.items[this.currentItem + this.options.slidesVisible] === undefined && index > this.currentItem)) {
            return;
        }
        let translateX = index * -100 / this.items.length
        if (animation === false) {
            this.disableTransition()
        }
        this.translate(translateX)
        this.container.offsetHeight
        if (animation === false) {
            this.enableTransition()
        }
        this.currentItem = index
        this.moveCallbacks.forEach(cb => cb(index))
    }

    resetInfinite() {
        if (this.currentItem <= this.options.slidesToScroll) {
            this.gotoItem(this.currentItem + (this.items.length - 2 * this.offset), false)
        } else if (this.currentItem >= this.items.length - this.offset) {
            this.gotoItem(this.currentItem - (this.items.length - 2 * this.offset), false)
        }
    }

    onMove(cb) {
        this.moveCallbacks.push(cb)
    }

    onWindowResize() {
        let mobile = window.innerWidth < 800
        if (mobile !== this.isMobile) {
            this.isMobile = mobile
            this.setStyle()
            this.moveCallbacks.forEach(cb => cb(this.currentItem))
        }
    }

    createDivWithClass(className) {
        let div = document.createElement('div')
        div.setAttribute('class', className)
        return div
    }

    disableTransition() {
        this.container.style.transition = 'none'
    }

    enableTransition() {
        this.container.style.transition = ''
    }

    get slidesToScroll() {
        return this.isMobile ? 1 : this.options.slidesToScroll
    }

    get slidesVisible() {
        return this.isMobile ? 1 : this.options.slidesVisible
    }

    get containerWidth() {
        return this.container.offsetWidth
    }

    get carouselWidth() {
        return this.root.offsetWidth
    }
}

document.addEventListener('DOMContentLoaded', function () {
    if(document.querySelector('#carousel1') != null){
        new Carousel(document.querySelector('#carousel1'), {
            slidesToScroll: 1,
            slidesVisible: 3,
            pagination: true,
            navigation: true,
            infinite: true
        })
    }

    if(document.querySelector('#carousel2') != null){
        new Carousel(document.querySelector('#carousel2'), {
            slidesToScroll: 1,
            slidesVisible: 3,
            pagination: true,
            navigation: true,
            infinite: true
        })
    }
})