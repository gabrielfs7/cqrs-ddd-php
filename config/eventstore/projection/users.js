fromCategory(':fromCategory')
.foreachStream()
.when(
    {
        $init: function() {
            return {
                total: 0,
                offset: 0,
                limit: 0,
                data: []
            }
        },
        UserCreated: function(state, event) {
            if (event.body.birthday.length > 0) {
                state.total++;
                state.data.push(
                    {
                        userId: event.body.id,
                        fullName: event.body.fullName,
                        username: event.body.username,
                        birthday: event.body.birthday,
                        totalOrders: 0,
                        totalOrderAmount: 0
                    }
                );
            }
        },
        UserUpdated: function(state, event) {
            for (var i = 0; i <= state.data.length; i++) {
                if (state.data[i].userId == event.body.id) {
                    state.data[i] = {
                        userId: event.body.id,
                        fullName: event.body.fullName,
                        username: event.body.username,
                        birthday: event.body.birthday
                    }
                }
            }
        },
        OrderCreated: function(state, event) {
            for (var i = 0; i <= state.data.length; i++) {
                if (state.data[i].userId == event.body.userId) {
                    state.data[i].totalOrders++;
                    state.data[i].totalOrderAmount += event.body.amount;
                }
            }
        }
    }
)