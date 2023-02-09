import { defaultDirection, localeOptions, defaultLocale } from '../constants/config'




export const mapOrder = (array, order, key) => {
  array.sort(function (a, b) {
    var A = a[key]
    var B = b[key]
    if (order.indexOf(A + '') > order.indexOf(B + '')) {
      return 1
    } else {
      return -1
    }
  })
  return array
}

export const getDateWithFormat = () => {
  const today = new Date()
  let dd = today.getDate()
  let mm = today.getMonth() + 1 // January is 0!

  var yyyy = today.getFullYear()
  if (dd < 10) {
    dd = '0' + dd
  }
  if (mm < 10) {
    mm = '0' + mm
  }
  return dd + '.' + mm + '.' + yyyy
}

export const getCurrentTime = () => {
 console.log((getCurrentLanguage()))
    if (getCurrentLanguage()=='fr' ) {
     return new Date().toLocaleDateString('en-us', { weekday:"long", year:"numeric", month:"short", day:"numeric"})

    }
     if(getCurrentLanguage()=='ar'){
    return new Date().toLocaleDateString('ar-EG', { weekday:"long", year:"numeric", month:"short", day:"numeric"})

     }

}



export const getDirection = () => {
  let direction = defaultDirection
  if (localStorage.getItem('direction')) {
    const localValue = localStorage.getItem('direction')
    if (localValue === 'rtl' || localValue === 'ltr') {
      direction = localValue
    }
  }
  return {
    direction,
    isRtl: direction === 'rtl'
  }
}

export const setDirection = localValue => {
  let direction = 'ltr'
  if (localValue === 'rtl' || localValue === 'ltr') {
    direction = localValue
  }
  localStorage.setItem('direction', direction)
}



export const getCurrentLanguage = () => {
  let locale = defaultLocale;
  try {
    if (localStorage.getItem('currentLanguage') && localeOptions.filter(x => x.id === localStorage.getItem('currentLanguage')).length > 0) { locale = localStorage.getItem('currentLanguage'); }
  } catch (error) {
    console.log(">>>> src/utils/index.js : getCurrentLanguage -> error", error)
    locale = defaultLocale;
  }
  return locale;
}

export const setCurrentLanguage = (lang) => {
  try {
    localStorage.setItem('currentLanguage', lang)
    document.querySelector('html').setAttribute('lang', lang)


    if (lang== 'ar'){
        setDirection('rtl')
        document.body.dir = "rtl";
    }
    else{

        setDirection('ltr')
        document.body.dir = "ltr";

    }
  } catch (error) {
    console.log(">>>> src/utils/index.js : setCurrentLanguage -> error", error)
  }

}
export function debounce(fn, wait){
    let timer;
   return function(...args){
     if(timer) {
        clearTimeout(timer); // clear any pre-existing timer
     }
     const context = this; // get the current context
     timer = setTimeout(()=>{
        fn.apply(context, args); // call the function if time expires
     }, wait);
   }
}
