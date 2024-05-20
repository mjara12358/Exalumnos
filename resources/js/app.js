import './bootstrap';
import 'flowbite';

function setThemePreference(theme) {
    document.documentElement.classList.toggle('dark', theme === 'dark');
    document.cookie = `theme=${theme}; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/`;

    const toggleThemeButton = document.getElementById('toggleThemeButton');

    const sunIcon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z"/></svg>'; // Aquí debes agregar el código SVG del ícono del sol

    const moonIcon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fillRule="evenodd" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z" clipRule="evenodd" /></svg>';


  // Reemplaza el contenido HTML del botón con el ícono correspondiente al tema
  toggleThemeButton.innerHTML = theme === 'dark' ?  moonIcon : sunIcon ;

}

  function toggleTheme() {
    const currentTheme = document.documentElement.classList.contains('dark') ? 'light' : 'dark';
    setThemePreference(currentTheme);
  }

  window.addEventListener('DOMContentLoaded', () => {
    const storedTheme = document.cookie.replace(/(?:(?:^|.*;\s*)theme\s*=\s*([^;]*).*$)|^.*$/, '$1');
    if (storedTheme) {
      setThemePreference(storedTheme);
    }
  });

  window.addEventListener('load', function () {
    document.documentElement.style.visibility = 'visible';
  });

  document.getElementById('toggleThemeButton').addEventListener('click', toggleTheme);

  ///////////////

  var config = {
      cUrl: 'https://api.countrystatecity.in/v1/countries',
      ckey: 'NHhvOEcyWk50N2Vna3VFTE00bFp3MjFKR0ZEOUhkZlg4RTk1MlJlaA=='
  }

  var countrySelect = document.querySelector('.country'),
      stateSelect = document.querySelector('.state'),
      citySelect = document.querySelector('.city')


  function loadCountries() {

      let apiEndPoint = config.cUrl

      fetch(apiEndPoint, {headers: {"X-CSCAPI-KEY": config.ckey}})
      .then(Response => Response.json())
      .then(data => {
          // console.log(data);

          data.forEach(country => {
              const option = document.createElement('option')
              option.value = country.iso2
              option.textContent = country.name 
              countrySelect.appendChild(option)
          })
      })
      .catch(error => console.error('Error loading countries:', error))

      stateSelect.disabled = true
      citySelect.disabled = true
      stateSelect.style.pointerEvents = 'none'
      citySelect.style.pointerEvents = 'none'
  }


  function loadStates() {
      stateSelect.disabled = false
      citySelect.disabled = true
      stateSelect.style.pointerEvents = 'auto'
      citySelect.style.pointerEvents = 'none'

      const selectedCountryCode = countrySelect.value
      // console.log(selectedCountryCode);
      stateSelect.innerHTML = '<option value="">Select State</option>' // for clearing the existing states
      citySelect.innerHTML = '<option value="">Select City</option>' // Clear existing city options

      fetch(`${config.cUrl}/${selectedCountryCode}/states`, {headers: {"X-CSCAPI-KEY": config.ckey}})
      .then(response => response.json())
      .then(data => {
          // console.log(data);

          data.forEach(state => {
              const option = document.createElement('option')
              option.value = state.iso2
              option.textContent = state.name 
              stateSelect.appendChild(option)
          })
      })
      .catch(error => console.error('Error loading countries:', error))
  }


  function loadCities() {
      citySelect.disabled = false
      citySelect.style.pointerEvents = 'auto'

      const selectedCountryCode = countrySelect.value
      const selectedStateCode = stateSelect.value
      // console.log(selectedCountryCode, selectedStateCode);

      citySelect.innerHTML = '<option value="">Select City</option>' // Clear existing city options

      fetch(`${config.cUrl}/${selectedCountryCode}/states/${selectedStateCode}/cities`, {headers: {"X-CSCAPI-KEY": config.ckey}})
      .then(response => response.json())
      .then(data => {
          // console.log(data);

          data.forEach(city => {
              const option = document.createElement('option')
              option.value = city.iso2
              option.textContent = city.name 
              citySelect.appendChild(option)
          })
      })
  }

  window.onload = loadCountries