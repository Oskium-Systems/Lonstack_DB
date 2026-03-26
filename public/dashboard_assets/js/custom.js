
    
function selectNetwork() {
    console.log("l");
  const newtorkSelect = document.getElementById('network');
  const denominationSelect = document.getElementById('denomination');
  const selectedNetwork = newtorkSelect.value;

  // Clear previous options
  denominationSelect.innerHTML = '<option value="">Select Denomination</option>';

  // Define options for each category
  const options = {
    mtn: [
      { value: 'MTN NGN100', text: 'MTN NGN100 [₦97]' },
     { value: 'MTN NGN200', text: 'MTN NGN100 [₦194]' },
        { value: 'MTN NGN500', text: 'MTN NGN500 [₦485]' },
        
         { value: 'MTN NGN1000', text: 'MTN NGN1000 [₦970]' },
        
         { value: 'MTN NGN1500', text: 'MTN NGN1500 [₦1,455]' },
      
    ],
    airtel: [
       { value: 'AIRTEL NGN100', text: 'AIRTEL NGN100 [₦96]' },
     { value: 'AIRTEL NGN200', text: 'AIRTEL NGN200 [₦192]' },
        
         { value: 'AIRTEL NGN500', text: 'AIRTEL NGN500 [₦481]' },
         { value: 'AIRTEL NGN1000', text: 'AIRTEL NGN1000 [₦963]' },
    ],
      
      glo: [
       { value: 'GLO NGN100', text: 'GLO NGN100 [₦96]' },
     { value: 'GLO NGN200', text: 'GLO NGN200 [₦192]' },
        
         { value: 'GLO NGN500', text: 'GLO NGN500 [₦481]' },
         { value: 'GLO NGN1000', text: 'GLO NGN1000 [₦963]' },
    ],
      
      etisalat: [
       { value: '9MOBILE NGN100', text: '9MOBILE NGN100 [₦94.50]' },
     { value: '9MOBILE NGN200', text: '9MOBILE NGN200 [₦189]' },
        
         { value: '9MOBILE NGN500', text: '9MOBILE NGN500 [₦472]' },
         { value: '9MOBILE NGN1000', text: '9MOBILE NGN1000 [₦945]' },
    ],
  };

  if (options[selectedNetwork]) {
    options[selectedNetwork].forEach(opt => {
      const option = document.createElement('option');
      option.value = opt.value;
      option.text = opt.text;
      denominationSelect.appendChild(option);
    });
  }
}    



  
