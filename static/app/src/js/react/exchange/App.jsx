export const ExchangeRate = React.createClass({

  _interval: 3000,
  _timeoutId: null,

  getInitialState: function() {
    return this.props;
  },

  componentDidMount: function() {
    this.polling();
  },

  componentWillUnmount() {
    clearInterval(this._timeoutId);
  },

  componentDidUpdate() {
    this._timeoutId = setTimeout(this.polling, this._interval);
  },

  polling: function polling() {
    const cb = function(payload) {
      if(payload.items) this.setState({ items: payload.items });
    }
    
    fetch('/', { headers: {'X-Requested-With': 'XMLHttpRequest'} })
    .then(res => res.json())
    .then(cb.bind(this))
    .catch(err => console.log(err))
  },

  getGroupItems: function() {
    let sorted = this.state.items.reduce((result, item) => {
      result[item.currency] = result[item.currency] || [];
      result[item.currency].push(item);
      return result;
    }, {});

    return Object.keys(sorted).map((key) => {
        return (
          <div className="row">
            <div className="col-sm-6 col-md-4 provider-item provider-item--currency">
              <h1>{ key }</h1>
            </div>
            { sorted[key].map((item, i) => <ExchangeRateItem key={i} {...item} />) }
          </div>
        );
    });
  },

  render: function() {
    return (
      <div className="row">
        { this.getGroupItems() }
      </div>
    );
  }
});

export const ExchangeRateItem = React.createClass({
  render: function() {
    return (
      <div className="col-sm-6 col-md-4 provider-item">
        <div className="thumbnail">
          <span className="label label-info">{ this.props.provider.toUpperCase() }</span>
          <div className="caption">
            <h1>{ this.props.rate }</h1>
          </div>
          <p>{ this.props.date_create }</p>
        </div>
      </div>
    );
  }
});

window.ExchangeRate = ExchangeRate;