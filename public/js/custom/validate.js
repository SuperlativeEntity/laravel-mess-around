function validateIdNumber(idNumber)
{
    var validIdNumber = true;

    if (idNumber.length != 13 || !isNumber(idNumber))
        validIdNumber = false;

    var tempDate = new Date(idNumber.substring(0, 2), idNumber.substring(2, 4) - 1, idNumber.substring(4, 6));

    var idDate = tempDate.getDate();
    var idMonth = tempDate.getMonth();

    if (!((tempDate.getYear() == idNumber.substring(0, 2)) &&
        (idMonth == idNumber.substring(2, 4) - 1) &&
        (idDate == idNumber.substring(4, 6))))
        validIdNumber = false;

    var tempTotal = 0;
    var checkSum = 0;
    var multiplier = 1;

    for (var i = 0; i < 13; ++i)
    {
        tempTotal = parseInt(idNumber.charAt(i)) * multiplier;

        if (tempTotal > 9)
            tempTotal = parseInt(tempTotal.toString().charAt(0)) + parseInt(tempTotal.toString().charAt(1));

        checkSum = checkSum + tempTotal;
        multiplier = (multiplier % 2 == 0) ? 1 : 2;
    }

    if ((checkSum % 10) != 0)
        validIdNumber = false;

    return validIdNumber;
}

function isNumber(n)
{
    return !isNaN(parseFloat(n)) && isFinite(n);
}