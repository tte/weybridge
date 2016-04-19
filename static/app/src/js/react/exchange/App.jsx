export const ExchangeRate = React.createClass({

  getInitialState: function() {
    return this.props;
  },

  componentDidMount: function() {
    this.polling();
  },

  polling: function polling() {
    console.log('polling');
    $.ajax({
      url: '/',
      success: (data) => {
        console.log(data);

        if(data.items) this.setState({ items: data.items });
        setTimeout(this.polling, 3000);
      },
      dataType: 'json',
    });
  },

  render: function() {
    let items = this.state.items.map((item, i) => <ExchangeRateItem key={i} {...item} />);

    return (
      <div className="row">
        { items }
      </div>
    );
  }
});

export const ExchangeRateItem = React.createClass({
  render: function() {
    return (
      <div className="col-sm-6 col-md-4 provider-item">
        <div className="thumbnail">
          <div className="caption">
            <h1>{ this.props.rate }</h1>
          </div>
          <p>{ this.props.provider }</p>
        </div>
      </div>
    );
  }
});

window.ExchangeRate = ExchangeRate;