var ip  = location.host;
const mysocket = io(ip+':3000');   

// ip = 'https://dosage-filme-eden-developing.trycloudflare.com';
// const mysocket = io(ip);    


function getLPrice(MyWatchScript= []) {
    mysocket.emit('updateData', {
        product: ((typeof MyWatchScript !== 'undefined') ? MyWatchScript : [])
    });
}

mysocket.on('connect', (sock) => {
    // mysocket.socket.sessionid;
    console.log('Connection established',mysocket.id);
    mysocket.emit('updateData', {
        product: ((typeof MyWatchScript !== 'undefined') ? MyWatchScript : [])
    });
});



mysocket.on('updateData', (marketData) => {
    // console.log('Received data:', marketData);
    if (marketData?.data?.Exchange !== undefined)
        setMarketValues(marketData);
});

mysocket.on('connect_error', (error) => {
    console.error('Socket.IO connection error:', error);
});

function setMarketValues(marketData) {
    // var Exchange = marketData.data.Exchange;
    var Exchange = '';
    var BuyPrice = marketData.data.BuyPrice;
    var InstrumentIdentifier = marketData.data.InstrumentIdentifier;
    var PriceChange = marketData.data.PriceChange;
    var PriceChangePercentage = marketData.data.PriceChangePercentage;

    // console.log('table portfolio content : ', $('div[data-script="' + InstrumentIdentifier + '"]').data())
    const portFolioRow = $('div[data-script="' + InstrumentIdentifier + '"]').data();
    if (portFolioRow != undefined) {
        const scriptData = {...portFolioRow, ...marketData.data}
        console.log('scriptData :: ', scriptData)

        const diff = Number((scriptData?.type == 'buy' ? scriptData?.BuyPrice - scriptData?.prev : scriptData?.prev - scriptData?.SellPrice)?.toFixed(2));
        const amount = diff * scriptData?.qty;
        const upAmount = scriptData?.up > 0 ? Number(((amount * scriptData?.up) / 100).toFixed(2)) : '0.00'
        const downAmount = scriptData?.down > 0 ? Number(((amount * scriptData?.down) / 100).toFixed(2)) : '0.00'
        const selfAmount = amount - (Number(upAmount) + Number(downAmount));
        
        const htmlRow = ['admin', 'master'].includes(scriptData?.role) ? 
            `<div class="col-6">UP :</div><div class="col-6 text-end p-0 at-upamount " val="${(amount > 0 ? -(upAmount) : Math.abs(upAmount)).toFixed(2)}">  ${(amount > 0 ? -(upAmount) : Math.abs(upAmount)).toFixed(2)}</div>
            <div class="col-6">D :</div><div class="col-6 text-end p-0 at-downamount" val="${(amount > 0 ? -(downAmount) : Math.abs(downAmount)).toFixed(2)}">  ${(amount > 0 ? -(downAmount) : Math.abs(downAmount)).toFixed(2)}</div>
            <div class="col-6">S :</div><div class="col-6 text-end p-0 at-selfamount" val="${(amount > 0 ? -(selfAmount) : Math.abs(selfAmount)).toFixed(2)}">  ${(amount > 0 ? -(selfAmount) : Math.abs(selfAmount)).toFixed(2)}</div>
            <div class="col-6">US :</div><div class="col-6 text-end p-0 at-amount" val="${(amount).toFixed(2)}">  ${(amount).toFixed(2)}</div>`
        :  `<div class="col-12 text-end p-0 at-amount" val="${(scriptData?.role=='broker'? (amount > 0 ? -(amount) : Math.abs(amount)) : amount).toFixed(2)}">${(scriptData?.role=='broker'? (amount > 0 ? -(amount) : Math.abs(amount)) : amount).toFixed(2)}</div>`;


        $('div[data-script="' + InstrumentIdentifier + '"]')?.html(`${htmlRow}`)
        getCounting()
    }

    var Options = ['BuyPrice', 'SellPrice', 'Open', 'LastTradePrice', 'High', 'Low', 'Close',
        'InstrumentIdentifier', 'PriceChange', 'PriceChangePercentage',];

    Options.forEach(opt_value => {

        if (marketData.data[opt_value] != undefined) {

            var curValue = $('.' + Exchange + InstrumentIdentifier + opt_value).html();

            $('.' + Exchange + InstrumentIdentifier + opt_value).html((marketData.data[opt_value])
            .toLocaleString('en-US', {
                style: 'decimal',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));

            $("[pl-"+opt_value+"="+InstrumentIdentifier+"]").html((marketData.data[opt_value])
            .toLocaleString('en-US', {
                style: 'decimal',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));

            $("[pl-"+opt_value+"="+InstrumentIdentifier+"]").html((marketData.data[opt_value])
            .toLocaleString('en-US', {
                style: 'decimal',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));
            
            // console.log('marketData.data[opt_value] :: ', marketData.data[opt_value])
            $("input[pl-"+opt_value+"="+InstrumentIdentifier+"]").val((marketData.data[opt_value])
                // .toLocaleString('en-US', {
                //     style: 'decimal',
                //     minimumFractionDigits: 2,
                //     maximumFractionDigits: 2
                // })
            );

            if (['BuyPrice', 'SellPrice', 'LastTradePrice'].indexOf(opt_value) !== -1) {

                var nowval = $('.' + Exchange + InstrumentIdentifier + opt_value).html();
                // console.log(curValue,nowval ,'<',(curValue<nowval),'==',(curValue==nowval),'>',(curValue>nowval));

                if (curValue < nowval)
                    $('td.' + Exchange + InstrumentIdentifier + opt_value).css('background-color',
                        '#28c76f');
                if (curValue > nowval)
                    $('td.' + Exchange + InstrumentIdentifier + opt_value).css('background-color',
                        '#ea5455');
                else
                    $('td.' + Exchange + InstrumentIdentifier + opt_value).css('background-color',
                        '#0C51C4');

            }
            // else if (['BuyPrice', 'SellPrice','LastTradePrice'].indexOf(opt_value) !== -1 && marketData.data['PriceChange'] < 0) {
            //     $('td.'+Exchange+InstrumentIdentifier+opt_value).css('background-color', '#BF2114');
            // }

            if (['PriceChange'].indexOf(opt_value) !== -1) {
                var iconlink = Exchange + InstrumentIdentifier + opt_value + 'icon';

                $('.' + iconlink).replaceWith(feather.icons[(marketData.data['PriceChange'] < 0 ?
                    'trending-down' : 'trending-up')].toSvg({
                    "class": (marketData.data['PriceChange'] < 0 ? 'text-danger' :
                        'text-success') + ' ' + iconlink
                }));

                $('.' + iconlink).closest('.avatar').removeClass((marketData.data['PriceChange'] < 0 ?
                    'bg-light-success' : 'bg-light-danger'));
                $('.' + iconlink).closest('.avatar').addClass((marketData.data['PriceChange'] > 0 ?
                    'bg-light-success' : 'bg-light-danger'));

                if (marketData.data['PriceChange'] < 0)
                    $('td.' + Exchange + InstrumentIdentifier + opt_value + 'icon').addClass('text-danger');
                else
                    $('td.' + Exchange + InstrumentIdentifier + opt_value + 'icon').removeClass('text-danger');
            }


        }
    });
}