
import { BaseFeature } from './feature/base/BaseFeature'
import { TestFeature } from './feature/test/TestFeature'



const FEATURE_CLASS: Record<string, typeof BaseFeature> = {
   test: TestFeature,

}


class Config {

  makeFeature(this: any, fn: string) {
    const fc = FEATURE_CLASS[fn]
    const fi = new fc()
    // TODO: errors etc
    return fi
  }


  main = {
    name: 'IssCurrentLocation',
  }


  feature = {
     test:     {
      "options": {
        "active": false
      }
    },

  }


  options = {
    base: "http://api.open-notify.org",

    headers: {
      "content-type": "application/json"
    },

    entity: {
      
      iss_location: {
      },

    }
  }


  entity = {
    "iss_location": {
      "fields": [
        {
          "name": "latitude",
          "req": true,
          "type": "`$STRING`"
        },
        {
          "name": "longitude",
          "req": true,
          "type": "`$STRING`"
        }
      ],
      "name": "iss_location",
      "op": {
        "load": {
          "input": "data",
          "name": "load",
          "points": [
            {
              "args": {
                "query": [
                  {
                    "kind": "query",
                    "name": "callback",
                    "orig": "callback",
                    "type": "`$STRING`"
                  }
                ]
              },
              "kind": "http",
              "method": "GET",
              "orig": "/iss-now.json",
              "parts": [
                "iss-now.json"
              ],
              "select": {
                "exist": [
                  "callback"
                ]
              },
              "transform": {
                "req": "`reqdata`",
                "res": "`body.iss_position`"
              }
            }
          ]
        }
      },
      "relations": {
        "ancestors": []
      }
    }
  }
}


const config = new Config()

export {
  config
}

