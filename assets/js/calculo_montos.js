document.addEventListener('DOMContentLoaded', () => {
    const montoBsInput = document.getElementById('monto_bs');
    const montoUsdInput = document.getElementById('monto_usd');
    const tasaBcvInput = document.getElementById('tasa_bcv');

    function actualizarMontos() {
        const tasa = parseFloat(tasaBcvInput.value);
        const montoBs = parseFloat(montoBsInput.value);
        const montoUsd = parseFloat(montoUsdInput.value);

        if (tasa) {
            if (montoBs) {
                montoUsdInput.value = (montoBs / tasa).toFixed(2);
            } else if (montoUsd) {
                montoBsInput.value = (montoUsd * tasa).toFixed(2);
            }
        }
    }

    // Escuchar cambios en los campos relevantes
    montoBsInput.addEventListener('input', actualizarMontos);
    montoUsdInput.addEventListener('input', actualizarMontos);
    tasaBcvInput.addEventListener('input', actualizarMontos);
});