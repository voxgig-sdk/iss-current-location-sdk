
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

  // False for a feature added at runtime via options.extend (station's
  // adopt path) - the constructor uses this to skip makeFeature for names
  // no generated class backs.
  hasFeature(this: any, fn: string) {
    return null != FEATURE_CLASS[fn]
  }


  main = {
    name: 'IssCurrentLocation',
        slug: "iss-current-location",
    version: "0.0.1",
    target: "ts",

  }


  feature = {
     test:     {
      "options": {
        "active": false
      },
      "transport": "base"
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
          "short": "Latitude coordinate of the ISS",
          "type": "`$STRING`"
        },
        {
          "name": "longitude",
          "req": true,
          "short": "Longitude coordinate of the ISS",
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

